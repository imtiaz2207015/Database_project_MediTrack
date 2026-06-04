# Oracle Database Setup for Medi_Track

## Step 1: Download Oracle Instant Client (Required for PHP OCI8)

Since you have Oracle Database installed, you need the Instant Client for your version.

### Option A: Download from Oracle Website
1. Go to: https://www.oracle.com/database/technologies/instant-client/downloads.html
2. Select your Oracle version (likely 19c or 21c)
3. Choose Windows 64-bit
4. Download: `instantclient-basic-windows.x64-*.zip`

### Option B: Use your existing Oracle installation
If Oracle is already installed on your system, find the location:
- Usually: `C:\Program Files\Oracle\product\19c` or similar

## Step 2: Extract & Configure

1. Extract the Instant Client ZIP to: `C:\oracle\instantclient_21_0` (or match your version)

2. Add to System Environment Variables:
   - Go to: Settings → Environment Variables
   - Create new variable: `ORACLE_HOME` = `C:\oracle\instantclient_21_0`
   - Add to PATH: `C:\oracle\instantclient_21_0`

3. Restart your computer (or restart Apache)

## Step 3: Update PHP Configuration

Your php.ini has been partially updated. Once Instant Client is installed:

1. Edit `C:\xampp\php\php.ini`
2. Find the Extensions section
3. Uncomment: `extension=php_oci8_19`
4. Restart Apache

## Step 4: Verify Installation

Run in PowerShell:
```powershell
C:\xampp\php\php.exe -m | findstr oci
```

Should show: `oci8`

## Step 5: Create Oracle User & Schema

Open SQL*Plus and run:

```sql
CREATE USER medi_track IDENTIFIED BY medi_track123;
GRANT CREATE SESSION TO medi_track;
GRANT CREATE TABLE TO medi_track;
GRANT CREATE SEQUENCE TO medi_track;
GRANT UNLIMITED TABLESPACE TO medi_track;
GRANT RESOURCE TO medi_track;
GRANT EXECUTE ON DBMS_SQL TO medi_track;
```

## Step 6: Update Laravel .env

```env
DB_CONNECTION=oracle
DB_HOST=127.0.0.1
DB_PORT=1521
DB_DATABASE=orcl
DB_USERNAME=medi_track
DB_PASSWORD=medi_track123
```

## Step 7: Run Migrations

```bash
cd c:\xampp\htdocs\Medi_Track
php artisan migrate
```

---

## Common Issues

### "Unable to load dynamic library 'php_oci8_19'"
- **Solution**: Install Oracle Instant Client (see above)

### "ORA-01017: invalid username/password"
- **Solution**: Check .env credentials match your Oracle user

### "ORA-12170: TNS:Connect timeout occurred"
- **Solution**: 
  - Ensure Oracle Listener is running
  - Check host/port in .env
  - Verify tnsnames.ora if using connection string

---

**Once you've installed Oracle Instant Client and created the user, run:**
```bash
php artisan migrate
```
