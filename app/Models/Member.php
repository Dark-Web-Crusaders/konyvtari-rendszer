<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'birth_date',
        'address',
        'email',
        'pin',
        'role',
        'deleted'
    ];

    // public function __construct($name, $birth_date, $address, $email, $pin)
    // {
    //     $this->name = $name;
    //     $this->birth_date = $birth_date;
    //     $this->address = $address;
    //     $this->email = $email;
    //     $this->pin = $pin;
    //     $this->role = 'EE';
    // }

    // public $bookLimit;
    // public $dayLimit;

    // // limits function
    // public function Limits()
    // {
    //     return [$bookLimit => 2, $dayLimit =>14];
    // }
}

// final class UniversityLecturer extends Member {

//     use HasParentModel;

//     public function __construct()
//     {
//         $member = parent::__construct();
//         $member->role = 'UL';
//     }

//     // limits function overdefinition
//     public function Limits()
//     {
//         return [$bookLimit => PHP_INT_MAX, $dayLimit =>365];
//     }

// }

// final class UniversityStudent extends Member {

//     public function __construct()
//     {
//         $member = parent::__construct();
//         $member->role = 'US';
//     }

//     // limits function overdefinition
//     public function Limits()
//     {
//         return [$bookLimit => 5, $dayLimit =>60];
//     }

// }

// final class OtherUniverityMembers  extends Member {

//     public function __construct()
//     {
//         $member = parent::__construct();
//         $member->role = 'OU';
//     }

//     // limits function overdefinition
//     public function Limits()
//     {
//         return [$bookLimit => 4, $dayLimit =>30];
//     }

// }
