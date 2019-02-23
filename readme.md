### PHP基于Grpc搭建【客户端】

### 生成客户端文件
```
// 根目录下执行
protoc --proto_path=./protos --php_out=./src/Services --grpc_out=./src/Services --plugin=protoc-gen-grpc=./../grpc/bins/opt/grpc_php_plugin ./protos/common/*.proto ./protos/users/*.proto
```

### 更新composer文件，添加生成客户端的自动依赖加载
```
// 添加依赖
"autoload": {
    "psr-4": {
      "Common\\": "src/Services/Common",
      "Users\\": "src/Services/Users",
      "GPBMetadata\\": "src/Services/GPBMetadata"
    }
}
// 更新composer的依赖管理
composer dump-autoload
```

### 测试调用服务端
```
php src/user.php
总数量：2
Id: 1, Name: qiang1
Id: 2, Name: qiang2
```