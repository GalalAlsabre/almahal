CREATE TABLE IF NOT EXISTS users (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    username TEXT NOT NULL UNIQUE,
    password TEXT NOT NULL,
    full_name TEXT,
    role TEXT CHECK(role IN ('admin', 'receptionist', 'accountant')) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS room_types (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT NOT NULL,
    base_price DECIMAL(10, 2) NOT NULL,
    description TEXT
);

CREATE TABLE IF NOT EXISTS rooms (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    room_number TEXT NOT NULL UNIQUE,
    floor INTEGER,
    type_id INTEGER,
    status TEXT CHECK(status IN ('available', 'busy', 'dirty', 'maintenance')) DEFAULT 'available',
    FOREIGN KEY (type_id) REFERENCES room_types(id) ON DELETE SET NULL
);

CREATE TABLE IF NOT EXISTS guests (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT NOT NULL,
    id_number TEXT,
    nationality TEXT,
    phone TEXT,
    id_image TEXT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS bookings (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    guest_id INTEGER,
    room_id INTEGER,
    check_in_date DATE NOT NULL,
    check_out_date DATE,
    actual_check_out DATETIME,
    total_amount DECIMAL(10, 2) DEFAULT 0.00,
    paid_amount DECIMAL(10, 2) DEFAULT 0.00,
    status TEXT CHECK(status IN ('active', 'completed', 'cancelled')) DEFAULT 'active',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (guest_id) REFERENCES guests(id),
    FOREIGN KEY (room_id) REFERENCES rooms(id)
);

CREATE TABLE IF NOT EXISTS accounts (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    code TEXT NOT NULL UNIQUE,
    name TEXT NOT NULL,
    type TEXT CHECK(type IN ('asset', 'liability', 'equity', 'revenue', 'expense')) NOT NULL,
    parent_id INTEGER,
    FOREIGN KEY (parent_id) REFERENCES accounts(id)
);

CREATE TABLE IF NOT EXISTS journal_entries (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    entry_date DATE NOT NULL,
    description TEXT,
    reference TEXT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS journal_items (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    entry_id INTEGER,
    account_id INTEGER,
    debit DECIMAL(10, 2) DEFAULT 0.00,
    credit DECIMAL(10, 2) DEFAULT 0.00,
    FOREIGN KEY (entry_id) REFERENCES journal_entries(id) ON DELETE CASCADE,
    FOREIGN KEY (account_id) REFERENCES accounts(id)
);

CREATE TABLE IF NOT EXISTS settings (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    setting_key TEXT UNIQUE NOT NULL,
    setting_value TEXT
);

-- Initial Data
INSERT INTO users (username, password, full_name, role) VALUES
('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'مدير النظام', 'admin');

INSERT INTO settings (setting_key, setting_value) VALUES
('hotel_name', 'فندق النجوم'),
('currency', 'YER'),
('tax_enabled', '0'),
('tax_rate', '0');

INSERT INTO accounts (code, name, type) VALUES
('1101', 'الصندوق الرئيسي', 'asset'),
('1102', 'البنك', 'asset'),
('1201', 'ذمم النزلاء', 'asset'),
('4101', 'إيرادات الإقامة', 'revenue'),
('4102', 'إيرادات الخدمات', 'revenue'),
('5101', 'مصروفات الصيانة', 'expense'),
('5102', 'مصروفات الكهرباء والماء', 'expense');
