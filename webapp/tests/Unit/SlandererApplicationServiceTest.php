<?php

namespace Tests\Unit;

use App\Domains\Tettwi\Models\Slanderers\Slanderer;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Application\Slanderer\SlandererApplicationService;
use App\Domains\Tettwi\Shared\TwitterIcon;
use App\Domains\Tettwi\Shared\TwitterId;
use App\Domains\Tettwi\Shared\TwitterUsername;
use App\Infrastructure\EloquentModels\EMUser;
use App\Infrastructure\Repositories\SlandererRepository;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class SlandererApplicationServiceTest extends TestCase
{
    use DatabaseTransactions;
    use DatabaseMigrations;

    private $user;

    public function setUp(): void
    {
        parent::setUp();
        Artisan::call('migrate:fresh --seed');
        $this->user = EMUser::find('9b0876b1-2ae1-422a-a212-b2994bb54047');
    }

    public function testRegister(): void
    {
        $twitter_id_str = '9696';
        $twitter_username_str = 'phpunit';
        $twitter_icon_str = 'test/icon';

        $twitter_id = new TwitterId($twitter_id_str);
        $twitter_username = new TwitterUsername($twitter_username_str);
        $twitter_icon = new TwitterIcon($twitter_icon_str);

        $repository = new SlandererRepository();
        $SlandererApp = new SlandererApplicationService($repository);
        $SlandererApp->register($twitter_id, $twitter_username, $twitter_icon);

        $slanderer_found = $repository->find($twitter_id);
        $slanderer_inputed = new Slanderer($twitter_id, $twitter_username, $twitter_icon);
        $this->assertEquals($slanderer_found, $slanderer_inputed);
    }
}
