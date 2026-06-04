#!/bin/bash
# Setup script for Oracle Database with Medi_Track
# This script helps configure Oracle Instant Client and create the database user

echo "=========================================="
echo "Medi_Track - Oracle Database Setup Guide"
echo "=========================================="
echo ""

# Check if Instant Client is installed
if ! command -v sqlplus &> /dev/null; then
    echo "⚠️  Oracle Instant Client not found."
    echo ""
    echo "STEP 1: Install Oracle Instant Client"
    echo "=================================="
    echo ""
    echo "1. Go to: https://www.oracle.com/database/technologies/instant-client/downloads.html"
    echo "2. Choose 'Instant Client Downloads' for your Oracle version"
    echo "3. Download for Windows x86-64: 'instantclient-basic-windows.x64-*.zip'"
    echo "4. Extract to: C:\oracle\instantclient_21_0"
    echo "5. Add to Windows PATH:"
    echo "   - Settings > Environment Variables"
    echo "   - Add: C:\oracle\instantclient_21_0"
    echo "6. Create ORACLE_HOME environment variable:"
    echo "   - Value: C:\oracle\instantclient_21_0"
    echo "7. Restart your computer"
    echo ""
    read -p "Press Enter after completing the above steps..."
fi

echo ""
echo "STEP 2: Create Oracle Database User"
echo "===================================="
echo ""
echo "Open SQL*Plus and run the following commands:"
echo ""
echo "sqlplus / as sysdba"
echo ""
echo "Then paste this SQL:"
echo "================================================"
cat << 'EOF'
CREATE USER medi_track IDENTIFIED BY medi_track123;
GRANT CREATE SESSION TO medi_track;
GRANT CREATE TABLE TO medi_track;
GRANT CREATE SEQUENCE TO medi_track;
GRANT UNLIMITED TABLESPACE TO medi_track;
GRANT RESOURCE TO medi_track;
GRANT EXECUTE ON DBMS_SQL TO medi_track;
EXIT;
EOF
echo "================================================"
echo ""
read -p "Press Enter after running the SQL commands..."

echo ""
echo "STEP 3: Enable PHP OCI8 Extension"
echo "==================================="
echo ""
echo "✓ Your php.ini has been updated."
echo "✓ You need to restart Apache for changes to take effect."
echo ""
echo "Next:"
echo "1. Open XAMPP Control Panel"
echo "2. Click 'Stop' for Apache (if running)"
echo "3. Click 'Start' for Apache"
echo ""
read -p "Press Enter after restarting Apache..."

echo ""
echo "STEP 4: Test PHP OCI8"
echo "====================="
echo ""
echo "Run in PowerShell:"
echo "  C:\xampp\php\php.exe -m | findstr oci"
echo ""
echo "You should see: oci8"
echo ""
read -p "Press Enter to continue..."

echo ""
echo "STEP 5: Run Laravel Migrations"
echo "=============================="
echo ""
echo "Run these commands:"
echo "  cd C:\xampp\htdocs\Medi_Track"
echo "  php artisan migrate"
echo ""
read -p "Press Enter after running migrations..."

echo ""
echo "=========================================="
echo "✓ Setup Complete!"
echo "=========================================="
echo ""
echo "Your Medi_Track application is now configured for Oracle Database."
echo ""
echo "Configuration:"
echo "  - Database: orcl"
echo "  - User: medi_track"
echo "  - Host: 127.0.0.1"
echo "  - Port: 1521"
echo ""
echo "For more information, see: ORACLE_SETUP.md"
