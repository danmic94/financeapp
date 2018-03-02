<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExpensesTest extends TestCase
{
    public function testsCreateExpenseSuccessfully()
    {
        $payload = [
            'description' => 'test123',
            'cost' => 125,
            'currency'=>"RON",
            'date' => '2017-01-01',
        ];

        $this->json('post', '/api/expense', $payload)
            ->assertStatus(201)
            ->assertSeeText("Resource created successfully 201");
    }

    public function testsUpdateExpenseSuccessfully()
    {
        $payload = [
            'id'=>1,
            'description' => 'The correct method to update things is put',
            'cost' => 125,
            'currency'=>"RON",
            'date' => '2017-01-01',
        ];

        $this->json('put', '/api/expenses/update', $payload)
            ->assertStatus(200)
            ->assertSeeText("The entry 1 has been successfully updated!");
    }

    public function testsDeleteExpenseSuccessfully()
    {
        $queryString = '?id=51';

        $this->json('delete', '/api/expenses/delete' . $queryString)
            ->assertStatus(204)
            ->assertSeeText('');
    }

    public function testsGetExpenseByIdSuccessfully()
    {
        $queryString = '?id=49';

        $this->json('get', '/api/expenses/show' . $queryString)
            ->assertStatus(200)
            ->assertJsonStructure([
                'id',
                'description',
                'cost',
                'currency',
                'date',
                'created_at',
                'updated_at'
            ]);
    }

    public function testsGetAllExpensesSuccessfully()
    {

        $this->json('get', '/api/expenses/')
            ->assertStatus(200)
            ->assertJsonStructure([[
                'id',
                'description',
                'cost',
                'currency',
                'date',
                'created_at',
                'updated_at'
            ]]);
    }
}
