<?php namespace App\Infrastructure\Repositories;


use App\Domain\Emails\Email;
use App\Domain\Emails\EmailRepositoryInterface;
use App\Domain\Shops\Shop;

class EloquentEmailRepository implements EmailRepositoryInterface{

    public function retrievePaginatedForShop($shop)
    {
        $emails = $shop->emails()->paginate(10);

        return $emails;
    }

    public function delete($id, $shopId)
    {
        return Shop::findOrFail($shopId)
            ->emails()
            ->delete($id);
    }

    public function save(Email $email, $shopId)
    {
        return Shop::findOrFail($shopId)
            ->emails()
            ->save($email);
    }
}