<?php

namespace Tests\Feature;

use App\Domain\Journals\Controllers\JournalsController;
use App\Domain\Journals\Entities\Journal;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class JournalControllerTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function test_the_journal_entry_list(): void
    {
        Journal::factory(4)->create();
        $this->get(action([JournalsController::class, 'index']))
            ->assertOk()
            ->assertJsonCount(4, 'payload');
    }

    public function test_the_journal_entry_save(): void
    {
        $requestData = [
            "title" => $this->faker->name,
            "body" => $this->faker->text(30),
            "date" => $this->faker->date
        ];
        $this->post(action([JournalsController::class, 'create']), $requestData)
            ->assertStatus(201)
            ->assertJsonStructure([
                'payload' => [
                    'id',
                ],
            ]);
    }

    public function test_the_journal_entry_detail(): void
    {
        $journal = Journal::factory()->create();
        $this->get(action([JournalsController::class, 'show'],['id'=> $journal->id]))
            ->assertOk()
            ->assertJsonPath('payload.id', $journal->id);
    }
}
