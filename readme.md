## sdk
针对http://filebox.markbest.site/ API编写的SDK

## 使用方法
```php
require_once 'autoload.php';  

use SDK\Client;  

$client = new Client('http://manage.mark-here.com/api/', 'admin@admin.com', '123456');
$result = $client->addAlbum('测试相册', '测试相册的简单描述');  //post
print_r($result);

$result = $client->listAlbums();   //get
print_r($result);

$result = $client->infoAlbum('2');   //get
print_r($result);

$result = $client->deleteAlbum('3');  //delete
print_r($result);

$result = $client->updateAlbum('3', 'mark的私人相册', '测试相册的简单描述');  //put
print_r($result);

$result = $client->listPictures();
print_r($result);

$data = array('album_id' => 0);
$result = $client->addPicture($data, 'D:\wamp\www\sdk\test.jpg');
print_r($result);

$result = $client->deletePicture('4');
print_r($result);

$result = $client->movePictureToAlbum('4', '0');
print_r($result);

$result = $client->infoPicture('2');
print_r($result);

$result = $client->listFolders();
print_r($result);

$result = $client->infoFolder('2');
print_r($result);

$result = $client->listFiles();
print_r($result);

$result = $client->infoFile('8');
print_r($result);
```
