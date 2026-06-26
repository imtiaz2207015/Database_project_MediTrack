<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // -----------------------------------------------
        // 1. USERS
        // -----------------------------------------------
        DB::table('users')->insert([
            [
                'name'       => 'Admin User',
                'email'      => 'admin@meditrack.com',
                'password'   => Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'       => 'Rahim Uddin',
                'email'      => 'rahim@meditrack.com',
                'password'   => Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'       => 'Salma Begum',
                'email'      => 'salma@meditrack.com',
                'password'   => Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // -----------------------------------------------
        // 2. CATEGORIES
        // -----------------------------------------------
        DB::table('categories')->insert([
            ['name' => 'Antibiotics',      'description' => 'Medicines that kill or inhibit bacteria',         'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Analgesics',       'description' => 'Pain relieving medicines',                         'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Antacids',         'description' => 'Medicines that neutralize stomach acid',           'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Antihistamines',   'description' => 'Medicines for allergic reactions',                 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Vitamins',         'description' => 'Nutritional supplements and vitamins',             'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Antidiabetics',    'description' => 'Medicines to control blood sugar levels',          'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Antihypertensive', 'description' => 'Medicines to lower high blood pressure',          'created_at' => now(), 'updated_at' => now()],
        ]);

        // -----------------------------------------------
        // 3. SUPPLIERS
        // -----------------------------------------------
        DB::table('suppliers')->insert([
            ['name' => 'Square Pharmaceuticals',  'contact_person' => 'Karim Hossain',  'phone' => '01711000001', 'email' => 'square@pharma.com',    'address' => 'Dhaka, Bangladesh',    'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Beximco Pharma',           'contact_person' => 'Nadia Islam',    'phone' => '01711000002', 'email' => 'beximco@pharma.com',   'address' => 'Gazipur, Bangladesh',  'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Incepta Pharmaceuticals',  'contact_person' => 'Tariq Ahmed',    'phone' => '01711000003', 'email' => 'incepta@pharma.com',   'address' => 'Dhamrai, Bangladesh',  'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Opsonin Pharma',           'contact_person' => 'Ritu Sharma',    'phone' => '01711000004', 'email' => 'opsonin@pharma.com',   'address' => 'Narayanganj, BD',      'created_at' => now(), 'updated_at' => now()],
            ['name' => 'ACI Limited',              'contact_person' => 'Mostofa Kamal',  'phone' => '01711000005', 'email' => 'aci@pharma.com',       'address' => 'Tejgaon, Dhaka',       'created_at' => now(), 'updated_at' => now()],
        ]);

        // -----------------------------------------------
        // 4. MEDICINES
        // -----------------------------------------------
        DB::table('medicines')->insert([
            // Antibiotics (category 1)
            ['category_id'=>1,'supplier_id'=>1,'name'=>'Amoxicillin','generic_name'=>'Amoxicillin','brand'=>'Moxacil','dosage_form'=>'capsule','strength'=>'500mg','price'=>12.00,'stock_quantity'=>200,'reorder_level'=>20,'expiry_date'=>'2027-06-01','batch_number'=>'B001','description'=>'Broad spectrum antibiotic','created_at'=>now(),'updated_at'=>now()],
            ['category_id'=>1,'supplier_id'=>2,'name'=>'Azithromycin','generic_name'=>'Azithromycin','brand'=>'Azithro','dosage_form'=>'tablet','strength'=>'250mg','price'=>35.00,'stock_quantity'=>150,'reorder_level'=>15,'expiry_date'=>'2027-08-01','batch_number'=>'B002','description'=>'Macrolide antibiotic','created_at'=>now(),'updated_at'=>now()],
            ['category_id'=>1,'supplier_id'=>3,'name'=>'Ciprofloxacin','generic_name'=>'Ciprofloxacin','brand'=>'Cipro','dosage_form'=>'tablet','strength'=>'500mg','price'=>18.00,'stock_quantity'=>180,'reorder_level'=>20,'expiry_date'=>'2026-12-01','batch_number'=>'B003','description'=>'Fluoroquinolone antibiotic','created_at'=>now(),'updated_at'=>now()],

            // Analgesics (category 2)
            ['category_id'=>2,'supplier_id'=>1,'name'=>'Paracetamol','generic_name'=>'Paracetamol','brand'=>'Napa','dosage_form'=>'tablet','strength'=>'500mg','price'=>2.00,'stock_quantity'=>500,'reorder_level'=>50,'expiry_date'=>'2027-01-01','batch_number'=>'B004','description'=>'Fever and pain relief','created_at'=>now(),'updated_at'=>now()],
            ['category_id'=>2,'supplier_id'=>2,'name'=>'Ibuprofen','generic_name'=>'Ibuprofen','brand'=>'Brufen','dosage_form'=>'tablet','strength'=>'400mg','price'=>8.00,'stock_quantity'=>300,'reorder_level'=>30,'expiry_date'=>'2027-03-01','batch_number'=>'B005','description'=>'Anti-inflammatory pain reliever','created_at'=>now(),'updated_at'=>now()],
            ['category_id'=>2,'supplier_id'=>4,'name'=>'Diclofenac','generic_name'=>'Diclofenac Sodium','brand'=>'Voltaren','dosage_form'=>'tablet','strength'=>'50mg','price'=>6.50,'stock_quantity'=>250,'reorder_level'=>25,'expiry_date'=>'2026-11-01','batch_number'=>'B006','description'=>'NSAID for pain and inflammation','created_at'=>now(),'updated_at'=>now()],

            // Antacids (category 3)
            ['category_id'=>3,'supplier_id'=>5,'name'=>'Omeprazole','generic_name'=>'Omeprazole','brand'=>'Losectil','dosage_form'=>'capsule','strength'=>'20mg','price'=>10.00,'stock_quantity'=>200,'reorder_level'=>20,'expiry_date'=>'2027-05-01','batch_number'=>'B007','description'=>'Proton pump inhibitor','created_at'=>now(),'updated_at'=>now()],
            ['category_id'=>3,'supplier_id'=>3,'name'=>'Antacid Suspension','generic_name'=>'Aluminium Hydroxide','brand'=>'Gelusil','dosage_form'=>'syrup','strength'=>'200mg/5ml','price'=>45.00,'stock_quantity'=>100,'reorder_level'=>10,'expiry_date'=>'2026-10-01','batch_number'=>'B008','description'=>'Liquid antacid','created_at'=>now(),'updated_at'=>now()],

            // Antihistamines (category 4)
            ['category_id'=>4,'supplier_id'=>2,'name'=>'Cetirizine','generic_name'=>'Cetirizine HCl','brand'=>'Alatrol','dosage_form'=>'tablet','strength'=>'10mg','price'=>5.00,'stock_quantity'=>350,'reorder_level'=>30,'expiry_date'=>'2027-07-01','batch_number'=>'B009','description'=>'Non-drowsy antihistamine','created_at'=>now(),'updated_at'=>now()],
            ['category_id'=>4,'supplier_id'=>1,'name'=>'Loratadine','generic_name'=>'Loratadine','brand'=>'Loratin','dosage_form'=>'tablet','strength'=>'10mg','price'=>6.00,'stock_quantity'=>200,'reorder_level'=>20,'expiry_date'=>'2027-04-01','batch_number'=>'B010','description'=>'Long-acting antihistamine','created_at'=>now(),'updated_at'=>now()],

            // Vitamins (category 5)
            ['category_id'=>5,'supplier_id'=>4,'name'=>'Vitamin C','generic_name'=>'Ascorbic Acid','brand'=>'C-Vit','dosage_form'=>'tablet','strength'=>'500mg','price'=>3.00,'stock_quantity'=>600,'reorder_level'=>50,'expiry_date'=>'2028-01-01','batch_number'=>'B011','description'=>'Immune booster vitamin','created_at'=>now(),'updated_at'=>now()],
            ['category_id'=>5,'supplier_id'=>5,'name'=>'Vitamin D3','generic_name'=>'Cholecalciferol','brand'=>'D-Vit','dosage_form'=>'capsule','strength'=>'1000IU','price'=>15.00,'stock_quantity'=>180,'reorder_level'=>20,'expiry_date'=>'2027-09-01','batch_number'=>'B012','description'=>'Bone health vitamin','created_at'=>now(),'updated_at'=>now()],

            // Antidiabetics (category 6)
            ['category_id'=>6,'supplier_id'=>1,'name'=>'Metformin','generic_name'=>'Metformin HCl','brand'=>'Glucophage','dosage_form'=>'tablet','strength'=>'500mg','price'=>9.00,'stock_quantity'=>220,'reorder_level'=>25,'expiry_date'=>'2027-02-01','batch_number'=>'B013','description'=>'First-line diabetes medicine','created_at'=>now(),'updated_at'=>now()],

            // Antihypertensive (category 7)
            ['category_id'=>7,'supplier_id'=>3,'name'=>'Amlodipine','generic_name'=>'Amlodipine Besylate','brand'=>'Amdocal','dosage_form'=>'tablet','strength'=>'5mg','price'=>7.00,'stock_quantity'=>190,'reorder_level'=>20,'expiry_date'=>'2027-06-15','batch_number'=>'B014','description'=>'Calcium channel blocker','created_at'=>now(),'updated_at'=>now()],
            ['category_id'=>7,'supplier_id'=>2,'name'=>'Enalapril','generic_name'=>'Enalapril Maleate','brand'=>'Renitec','dosage_form'=>'tablet','strength'=>'5mg','price'=>11.00,'stock_quantity'=>8,'reorder_level'=>20,'expiry_date'=>'2026-08-01','batch_number'=>'B015','description'=>'ACE inhibitor for hypertension','created_at'=>now(),'updated_at'=>now()],
        ]);

        // -----------------------------------------------
        // 5. CUSTOMERS
        // -----------------------------------------------
        DB::table('customers')->insert([
            ['name'=>'Md. Jahirul Islam',   'phone'=>'01812000001','email'=>'jahir@gmail.com',  'address'=>'Mirpur, Dhaka',      'created_at'=>now(),'updated_at'=>now()],
            ['name'=>'Fatema Khatun',        'phone'=>'01812000002','email'=>'fatema@gmail.com', 'address'=>'Uttara, Dhaka',      'created_at'=>now(),'updated_at'=>now()],
            ['name'=>'Rafiqul Hasan',        'phone'=>'01812000003','email'=>null,               'address'=>'Sylhet',             'created_at'=>now(),'updated_at'=>now()],
            ['name'=>'Nasrin Akter',         'phone'=>'01812000004','email'=>'nasrin@gmail.com', 'address'=>'Chittagong',         'created_at'=>now(),'updated_at'=>now()],
            ['name'=>'Sabbir Rahman',        'phone'=>'01812000005','email'=>null,               'address'=>'Narayanganj',        'created_at'=>now(),'updated_at'=>now()],
            ['name'=>'Kohinoor Begum',       'phone'=>'01812000006','email'=>'kohinoor@mail.com','address'=>'Rajshahi',           'created_at'=>now(),'updated_at'=>now()],
        ]);

        // -----------------------------------------------
        // 6. SALES
        // -----------------------------------------------
        DB::table('sales')->insert([
            ['customer_id'=>1,'user_id'=>1,'total_amount'=>119.00,'discount'=>0,  'paid_amount'=>119.00,'payment_method'=>'cash',          'status'=>'completed','created_at'=>now(),'updated_at'=>now()],
            ['customer_id'=>2,'user_id'=>2,'total_amount'=>85.00, 'discount'=>5,  'paid_amount'=>80.00, 'payment_method'=>'mobile_banking','status'=>'completed','created_at'=>now(),'updated_at'=>now()],
            ['customer_id'=>3,'user_id'=>1,'total_amount'=>46.00, 'discount'=>0,  'paid_amount'=>46.00, 'payment_method'=>'cash',          'status'=>'completed','created_at'=>now(),'updated_at'=>now()],
            ['customer_id'=>4,'user_id'=>3,'total_amount'=>200.00,'discount'=>10, 'paid_amount'=>190.00,'payment_method'=>'card',          'status'=>'completed','created_at'=>now(),'updated_at'=>now()],
            ['customer_id'=>5,'user_id'=>2,'total_amount'=>60.00, 'discount'=>0,  'paid_amount'=>60.00, 'payment_method'=>'cash',          'status'=>'pending',  'created_at'=>now(),'updated_at'=>now()],
        ]);

        // -----------------------------------------------
        // 7. SALE ITEMS
        // -----------------------------------------------
        DB::table('sale_items')->insert([
            // Sale 1: Amoxicillin x5 + Paracetamol x10 + Cetirizine x3
            ['sale_id'=>1,'medicine_id'=>1,'quantity'=>5, 'unit_price'=>12.00,'subtotal'=>60.00, 'created_at'=>now(),'updated_at'=>now()],
            ['sale_id'=>1,'medicine_id'=>4,'quantity'=>10,'unit_price'=>2.00, 'subtotal'=>20.00, 'created_at'=>now(),'updated_at'=>now()],
            ['sale_id'=>1,'medicine_id'=>9,'quantity'=>3, 'unit_price'=>5.00, 'subtotal'=>15.00, 'created_at'=>now(),'updated_at'=>now()],

            // Sale 2: Azithromycin x2 + Ibuprofen x5 + Vitamin C x5
            ['sale_id'=>2,'medicine_id'=>2,'quantity'=>2, 'unit_price'=>35.00,'subtotal'=>70.00, 'created_at'=>now(),'updated_at'=>now()],
            ['sale_id'=>2,'medicine_id'=>5,'quantity'=>1, 'unit_price'=>8.00, 'subtotal'=>8.00,  'created_at'=>now(),'updated_at'=>now()],

            // Sale 3: Omeprazole x3 + Antacid x1
            ['sale_id'=>3,'medicine_id'=>7,'quantity'=>3, 'unit_price'=>10.00,'subtotal'=>30.00, 'created_at'=>now(),'updated_at'=>now()],
            ['sale_id'=>3,'medicine_id'=>8,'quantity'=>1, 'unit_price'=>45.00,'subtotal'=>45.00, 'created_at'=>now(),'updated_at'=>now()],  // Note: intentionally > total for demo

            // Sale 4: Metformin x10 + Amlodipine x10 + Vitamin D3 x5
            ['sale_id'=>4,'medicine_id'=>13,'quantity'=>10,'unit_price'=>9.00, 'subtotal'=>90.00, 'created_at'=>now(),'updated_at'=>now()],
            ['sale_id'=>4,'medicine_id'=>14,'quantity'=>10,'unit_price'=>7.00, 'subtotal'=>70.00, 'created_at'=>now(),'updated_at'=>now()],

            // Sale 5: Paracetamol x20 + Loratadine x4
            ['sale_id'=>5,'medicine_id'=>4,'quantity'=>20,'unit_price'=>2.00, 'subtotal'=>40.00, 'created_at'=>now(),'updated_at'=>now()],
            ['sale_id'=>5,'medicine_id'=>10,'quantity'=>4,'unit_price'=>6.00, 'subtotal'=>24.00, 'created_at'=>now(),'updated_at'=>now()],  // Note: intentionally > total for demo
        ]);

        // -----------------------------------------------
        // 8. PURCHASES
        // -----------------------------------------------
        DB::table('purchases')->insert([
            ['supplier_id'=>1,'user_id'=>1,'total_amount'=>5000.00,'status'=>'received','purchase_date'=>'2025-05-01','created_at'=>now(),'updated_at'=>now()],
            ['supplier_id'=>2,'user_id'=>2,'total_amount'=>3200.00,'status'=>'received','purchase_date'=>'2025-05-05','created_at'=>now(),'updated_at'=>now()],
            ['supplier_id'=>3,'user_id'=>1,'total_amount'=>2800.00,'status'=>'pending', 'purchase_date'=>'2025-05-10','created_at'=>now(),'updated_at'=>now()],
            ['supplier_id'=>4,'user_id'=>3,'total_amount'=>1500.00,'status'=>'received','purchase_date'=>'2025-05-12','created_at'=>now(),'updated_at'=>now()],
        ]);

        // -----------------------------------------------
        // 9. PURCHASE ITEMS
        // -----------------------------------------------
        DB::table('purchase_items')->insert([
            // Purchase 1 from Square Pharma
            ['purchase_id'=>1,'medicine_id'=>1,'quantity'=>500,'unit_price'=>8.00, 'subtotal'=>4000.00,'created_at'=>now(),'updated_at'=>now()],
            ['purchase_id'=>1,'medicine_id'=>4,'quantity'=>500,'unit_price'=>1.00, 'subtotal'=>500.00, 'created_at'=>now(),'updated_at'=>now()],
            ['purchase_id'=>1,'medicine_id'=>11,'quantity'=>100,'unit_price'=>2.00,'subtotal'=>200.00, 'created_at'=>now(),'updated_at'=>now()],

            // Purchase 2 from Beximco
            ['purchase_id'=>2,'medicine_id'=>2,'quantity'=>200,'unit_price'=>22.00,'subtotal'=>4400.00,'created_at'=>now(),'updated_at'=>now()],
            ['purchase_id'=>2,'medicine_id'=>9,'quantity'=>300,'unit_price'=>3.00, 'subtotal'=>900.00, 'created_at'=>now(),'updated_at'=>now()],

            // Purchase 3 from Incepta
            ['purchase_id'=>3,'medicine_id'=>3,'quantity'=>200,'unit_price'=>12.00,'subtotal'=>2400.00,'created_at'=>now(),'updated_at'=>now()],
            ['purchase_id'=>3,'medicine_id'=>14,'quantity'=>200,'unit_price'=>4.00,'subtotal'=>800.00, 'created_at'=>now(),'updated_at'=>now()],

            // Purchase 4 from Opsonin
            ['purchase_id'=>4,'medicine_id'=>6,'quantity'=>150,'unit_price'=>4.00, 'subtotal'=>600.00, 'created_at'=>now(),'updated_at'=>now()],
            ['purchase_id'=>4,'medicine_id'=>12,'quantity'=>100,'unit_price'=>9.00,'subtotal'=>900.00, 'created_at'=>now(),'updated_at'=>now()],
        ]);

        // -----------------------------------------------
        // 10. PRESCRIPTIONS
        // -----------------------------------------------
        DB::table('prescriptions')->insert([
            ['customer_id'=>1,'sale_id'=>1,'doctor_name'=>'Dr. Anwar Hossain',  'doctor_phone'=>'01911111101','notes'=>'Take after meals. Full course required.','prescribed_date'=>'2025-05-20','created_at'=>now(),'updated_at'=>now()],
            ['customer_id'=>2,'sale_id'=>2,'doctor_name'=>'Dr. Shahana Parvin', 'doctor_phone'=>'01911111102','notes'=>'Avoid cold water.','prescribed_date'=>'2025-05-18','created_at'=>now(),'updated_at'=>now()],
            ['customer_id'=>4,'sale_id'=>4,'doctor_name'=>'Dr. Rafiq Uddin',    'doctor_phone'=>'01911111103','notes'=>'Check BP weekly. Low sodium diet.','prescribed_date'=>'2025-05-15','created_at'=>now(),'updated_at'=>now()],
            ['customer_id'=>6,'sale_id'=>null,'doctor_name'=>'Dr. Mitu Akter',  'doctor_phone'=>'01911111104','notes'=>'Vitamin deficiency noted.','prescribed_date'=>'2025-05-22','created_at'=>now(),'updated_at'=>now()],
        ]);

        // -----------------------------------------------
        // 11. STOCK ADJUSTMENTS
        // -----------------------------------------------
        DB::table('stock_adjustments')->insert([
            ['medicine_id'=>8, 'user_id'=>1,'type'=>'decrease','quantity'=>5, 'reason'=>'Damaged bottles found in storage',     'created_at'=>now(),'updated_at'=>now()],
            ['medicine_id'=>14,'user_id'=>2,'type'=>'decrease','quantity'=>3, 'reason'=>'Expired stock removed',                'created_at'=>now(),'updated_at'=>now()],
            ['medicine_id'=>4, 'user_id'=>1,'type'=>'increase','quantity'=>100,'reason'=>'Emergency restock from local supplier','created_at'=>now(),'updated_at'=>now()],
            ['medicine_id'=>11,'user_id'=>3,'type'=>'decrease','quantity'=>10,'reason'=>'Donated to health camp',               'created_at'=>now(),'updated_at'=>now()],
            ['medicine_id'=>7, 'user_id'=>2,'type'=>'increase','quantity'=>50,'reason'=>'Bonus stock from supplier promotion',  'created_at'=>now(),'updated_at'=>now()],
        ]);
    }
}