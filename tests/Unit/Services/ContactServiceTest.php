<?php

declare(strict_types=1);

namespace Tests\Unit\Services;

use App\Models\Company;
use App\Models\Contact;
use App\Models\User;
use DateTimeImmutable;
use Domains\Network\Aggregates\ContactAggregate;
use Domains\Network\Entities\ContactEntity;
use Domains\Network\Repositories\ContactRepository;
use Domains\Network\Services\ContactService;
use Domains\Network\ValueObjects\EmailObject;
use Domains\Network\ValueObjects\NameObject;
use Illuminate\Database\DatabaseManager;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

final class ContactServiceTest extends TestCase
{
    #[Test]
    public function it_can_get_all_contacts(): void
    {
        Contact::factory()->count(10)->create();

        foreach ($this->service()->all() as $contact) {
            $this->assertInstanceOf(
                expected: ContactEntity::class,
                actual: $contact,
            );
        }
    }

    #[Test]
    public function it_can_get_the_aggregate(): void
    {
        $contact = Contact::factory()->for(Company::factory()->create())->create();

        $this->assertInstanceOf(
            expected: ContactEntity::class,
            actual: $this->service()->aggregate(
                id: $contact->id,
            )->contact(),
        );
    }

    #[Test]
    public function it_can_create_a_new_contact(): void
    {
        $user = User::factory()->create();

        $this->assertEquals(
            expected: 0,
            actual: Contact::query()->count(),
        );

        $this->service()->create(
            contact: new ContactEntity(
                name: new NameObject(
                    first: 'Stephen',
                    middle: 'Andrew',
                    last: 'McDougall',
                    preferred: 'Steve',
                ),
                email: new EmailObject(
                    email: 'steve@treblle.com',
                ),
                socials: [
                    'twitter' => 'juststeveking',
                    'github' => 'juststeveking',
                    'youtube' => 'juststeveking',
                ],
                role: 'Developer Advocate',
                pronouns: 'he/him',
                birthday: new DateTimeImmutable(
                    datetime: '09/09/1988',
                ),
            ),
            user: $user->id,
        );

        $this->assertEquals(
            expected: 1,
            actual: Contact::query()->count(),
        );
    }

    #[Test]
    public function it_can_update_a_contact(): void
    {
        $contact = Contact::factory()->create([
            'role' => 'Developer Advocate',
        ]);

        $entity = ContactEntity::fromEloquent(
            contact: $contact,
        );

        $entity->role = 'Developer';

        $this->service()->update(
            id: $contact->id,
            contact: $entity,
        );

        $this->assertEquals(
            expected: 'Developer',
            actual: Contact::query()->first()->role,
        );
    }

    #[Test]
    public function it_can_delete_a_contact(): void
    {
        $contact = Contact::factory()->create();

        $this->assertEquals(
            expected: 1,
            actual: Contact::query()->count(),
        );

        $this->service()->delete(
            id: $contact->id,
        );

        $this->assertEquals(
            expected: 0,
            actual: Contact::query()->count(),
        );
    }

    protected function service(): ContactService
    {
        return new ContactService(
            repository: new ContactRepository(
                query: Contact::query(),
                database: resolve(DatabaseManager::class),
            ),
        );
    }
}
