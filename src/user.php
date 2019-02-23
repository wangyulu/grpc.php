<?php
/**
 * Created by PhpStorm.
 * User: sky
 * Date: 2019-02-21
 * Time: 15:18
 */

require __DIR__.'/../vendor/autoload.php';

use Common\Page;
use Users\UserListsReq;
use Users\UsersClient;

$page = new Page();
$page->setKeyword("keyword php");
$page->setPageNo(1);
$page->setPageSize(20);

$userListReq = new UserListsReq();
$userListReq->setPage($page);

$client = new UsersClient("127.0.0.1:1122",[
    'credentials' => Grpc\ChannelCredentials::createInsecure(),
]);

list($reply, $status) = $client->Lists($userListReq)->wait();
if ($status->code != 0){
    exit($status->details);
}
$users = $reply->getUsers();
echo "总数量：{$users->count()} \n";
$iterator = $users->getIterator();

while ($iterator->valid()){
    echo "Id: {$iterator->current()->getId()}, Name: {$iterator->current()->getName()} \n";
    $iterator->next();
}
