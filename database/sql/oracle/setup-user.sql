-- Oracle user setup for Medi_Track
-- Run this as a DBA user if needed.

CREATE USER medi_track IDENTIFIED BY medi_track123;
GRANT CREATE SESSION TO medi_track;
GRANT CREATE TABLE TO medi_track;
GRANT CREATE SEQUENCE TO medi_track;
GRANT UNLIMITED TABLESPACE TO medi_track;
GRANT RESOURCE TO medi_track;
GRANT EXECUTE ON DBMS_SQL TO medi_track;
