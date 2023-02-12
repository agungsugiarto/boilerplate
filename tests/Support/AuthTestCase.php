<?php

declare(strict_types=1);

namespace Tests\Support;

use CodeIgniter\Session\Handlers\ArrayHandler;

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\ControllerTestTrait;
use CodeIgniter\Test\DatabaseTestTrait;
use CodeIgniter\Test\Mock\MockSession;
use Config\Services;
use Faker\Factory;
use Faker\Generator;
use Myth\Auth\Entities\User;
use Myth\Auth\Models\UserModel;
use ReflectionException;

/**
 * @internal
 */
abstract class AuthTestCase extends CIUnitTestCase
{
    use DatabaseTestTrait;
    use ControllerTestTrait;

    /**
     * Should the database be refreshed before each test?
     *
     * @var bool
     */
    protected $refresh = true;

    /**
     * The name of a seed file used for all tests within this test case.
     *
     * @var string
     */
    protected $seed = 'agungsugiarto\boilerplate\Database\Seeds\BoilerplateSeeder';

    /**
     * The namespace to help us find the migration classes.
     *
     * @var string[]
     */
    protected $namespace = ['Myth\Auth', 'agungsugiarto\boilerplate'];

    protected UserModel $users;
    protected Generator $faker;
    protected MockSession $mockSession;

    protected function setUp(): void
    {
        parent::setUp();

        $this->users = new UserModel();
        $this->mockSession();

        $this->faker = Factory::create();
    }

    /**
     * Pre-loads the mock session driver into $this->session.
     */
    protected function mockSession()
    {
        require_once SYSTEMPATH . 'Test/Mock/MockSession.php';
        $config            = config('App');
        $this->mockSession = new MockSession(new ArrayHandler($config, '0.0.0.0'), $config);
        Services::injectMock('session', $this->mockSession);
        $_SESSION = [];
    }

    /**
     * Creates a user on-the-fly.
     *
     * @throws ReflectionException
     */
    protected function createUser(array $info = []): ?object
    {
        $defaults = [
            'email'    => 'fred@example.com',
            'username' => 'Fred',
            'password' => 'secret',
        ];
        $info = array_merge($info, $defaults);
        $user = new User($info);

        $userId = $this->users->insert($user);
        $user   = $this->users->find($userId);

        // Delete any cached permissions
        cache()->delete("{$userId}_permissions");

        return $user;
    }

    /**
     * Creates a group on the fly.
     *
     * @return mixed
     */
    protected function createGroup(array $info = [])
    {
        $defaults = [
            'name'        => $this->faker->word,
            'description' => $this->faker->sentence,
        ];
        $info = array_merge($info, $defaults);

        $this->db->table('auth_groups')->insert($info);

        return $this->db->table('auth_groups')->where('id', $this->db->insertID())->get()->getResultObject()[0];
    }

    /**
     * Creates a new permission on the fly.
     *
     * @return mixed
     */
    protected function createPermission(array $info = [])
    {
        $defaults = [
            'name'        => $this->faker->word,
            'description' => $this->faker->sentence,
        ];
        $info = array_merge($info, $defaults);

        $this->db->table('auth_permissions')->insert($info);

        return $this->db->table('auth_permissions')->where('id', $this->db->insertID())->get()->getResultObject()[0];
    }
}
