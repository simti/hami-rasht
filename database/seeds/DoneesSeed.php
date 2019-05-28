<?php

use Illuminate\Database\Seeder;
use App\Donee;

class DoneesSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      Donee::create([
        'id' => 1,
        'file_number' => '1234',
        'full_name' => 'احمد محمدی',
        'father_name' => 'سینا',
        'birth_date' => 12345654,
        'birth_certificate_id' => '7483029980',
        'national_id' => '3422345643',
        'bank_account_number' => '22222',
        'bank_card_number' => "222222222",
        'bank_account_owner' => 'رضا دولتی',
        'bank_name' => "ملی",
        'bank_branch_name' => 'رشت',
        'education' => 'دیپلم',
        'gender' => 1,
        'membership_start_date' => 12344322,
        'address' => 'ادرس تستی',
        'mobile' => '09116030439',
        'phone' => '33760413',
        'organization_branch' => 1,
        'number_of_disabled_members_in_family' => 0,
        'number_of_family_members' => 4,
        'disabled' => false,
        'reasons_to_help' => 'ناتوانی جسمی',

      ]);
      Donee::create([
        'id' => 2,
        'file_number' => '12344',
        'full_name' => 'نگار بهارستانی',
        'father_name' => 'مانی',
        'birth_date' => 12345654,
        'birth_certificate_id' => '4572947135',
        'national_id' => '9382117453',
        'bank_account_number' => '22222',
        'bank_card_number' => "222222222",
        'bank_account_owner' => 'رضا دولتی',
        'bank_name' => "ملی",
        'bank_branch_name' => 'رشت',
        'education' => 'دیپلم',
        'gender' => 1,
        'membership_start_date' => 12344322,
        'address' => 'ادرس تستی',
        'mobile' => '09116030439',
        'phone' => '33760413',
        'organization_branch' => 1,
        'number_of_disabled_members_in_family' => 0,
        'number_of_family_members' => 4,
        'disabled' => false,
        'reasons_to_help' => 'ناتوانی جسمی',
      ]);
      Donee::create([
        'id' => 3,
        'file_number' => '12342',
        'full_name' => 'مریم محمدی',
        'father_name' => 'سینا',
        'birth_date' => 12345654,
        'birth_certificate_id' => '340432112',
        'national_id' => '8492773221',
        'bank_account_number' => '22222',
        'bank_card_number' => "222222222",
        'bank_account_owner' => 'رضا دولتی',
        'bank_name' => "ملی",
        'bank_branch_name' => 'رشت',
        'education' => 'دیپلم',
        'gender' => 1,
        'membership_start_date' => 12344322,
        'address' => 'ادرس تستی',
        'mobile' => '09116030439',
        'phone' => '33760413',
        'organization_branch' => 1,
        'number_of_disabled_members_in_family' => 0,
        'number_of_family_members' => 4,
        'disabled' => false,
        'reasons_to_help' => 'ناتوانی جسمی',
      ]);
    }
}
