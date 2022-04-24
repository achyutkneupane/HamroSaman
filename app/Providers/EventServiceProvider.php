<?php

namespace App\Providers;

use App\Models\Auction;
use App\Notifications\AuctionEnded;
use App\Notifications\ProductBought;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Schema;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        if(Schema::hasTable('auctions') && Schema::hasTable('bids')) {
            $to_end = Auction::with('bids','product.user')->where('winner_id', null)->where('end_at', '<', Carbon::now())->get();
            if($to_end->count() <= 0) return;
            $to_end->each(function($auction) {
                if($auction->bids()->count() <= 0) return;
                $highest_bid = $auction->bids()->orderBy('amount', 'desc')->first();
                $highest_bid->is_winner = true;
                $highest_bid->save();
                $auction->winner_id = $highest_bid->user_id;
                $auction->save();
                $auction->product->user->notify(new AuctionEnded($auction));
                $highest_bid->user->notify(new ProductBought($auction));
            });
        }
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}
