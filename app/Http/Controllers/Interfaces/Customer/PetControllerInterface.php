<?php

namespace App\Http\Controllers\Interfaces\Customer;

use Illuminate\Http\Request;

interface PetControllerInterface
{
    public function index();
    public function store(Request $request);
    public function update(Request $request);
    public function validatePet($request);
    public function delete(Request $request);
    public function getId(Request $request);
    public function getBreedByType(Request $request);
}