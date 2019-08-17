# mt_util_func.php
个人日常工作学习中的php常用函数方法积累，欢迎大家补充。php交流Q群：294088839
## 方法说明
### deep_diff_array($arr1, $arr2)
* 功能：二维数组diff
* 说明：找出数组$arr1中存在的value值，$arr2不存在的值value
* 举例：$arr1=['a'=>1,'b'=>2];$arr2=['c'=>2,'d'=>4];
* 输出：['a'=>1];

### dataSortByMoreField()
* 功能：二维数组多字段排序
* 说明：可以根据字段不同维度给数组排序
* 举例：dataSortByMoreField($arr,'k1',SORT_DESC,'k2','SORT_ASC')

### create_dir($dir)
* 功能：递归创建文件夹
* 说明：此方法跟命令 mkdir -p $dir效果相同，在上级目录不存在时自动创建上级目录
* 举例：$dir='/var/local/tang/zhi/qin'

### time_diff( $begin_time, $end_time )
* 功能：倒计时
* 说明：$begin_time开始时间，$end_time,结束时间
* 举例：输入$begin_time=time();$end_time="2019-05-01";

### unit_convert($num, $unit='', $point = 2)
* 功能：单位换算
* 说明：$num输入数字，$unit输入的单位(默认为空)，$point保留小数(默认两位)
* 举例：输入:$num=10000;$unit='';$point=3;输出:['value'=>1.000,'unit'=>'万']

### quick_sort($arr)
* 功能：快速排序
* 说明：$arr数字数组，输出结果顺序为ASC
* 举例：输入:[3,2,7,9,1]输出:[1,2,3,7,9]

### get_real_ip()
* 功能：获取真实IP

### get_client_device()
* 功能：获取client设备

### curl_get($url, $post='')
* 功能：curl_get_post请求
* 说明：$url为链接，$post为字符串(例:"a=22&b=44")

### curl_post($url, $param)
* 功能：保持长连接post
* 说明：$url为链接，$param为key-value数组

### get_ini_config($filename)
* 功能：读取配置文件，以数组形式输出

### get_file_list($path, $type='all')
* 功能：获取目录下文件列表
* 说明：$type=all/linux,all所有系统可用

### mutil_process($p = 4, $func = function(){})
* 功能：多进程回调执行函数
* 说明：$p是进程数，$func 传入的回调函数；

### hex2color($c)
* 功能：十六进制颜色转RGB
* 举例：$c = "#FF00D4"

### get_file_unit($file)
* 功能：格式化文件单位

# simple_socket
简单实现TCP服务端和客户端，仅供参考
## 类说明

### server.php
* 功能：启动服务端

### client.php
* 功能：启动客户端

### socket.php
* 功能：工厂封装基类
* 说明：使用方法Factory::getInstance('client')，获取客户端实例，服务端同

一:字符串处理
| 函数名| 描述 | 
| ------ | ------ | ------ |
| strtolower |将字符串转化为小写 |
| strtoupper|将字符串转化为大写 |
| ucfirst |将字符串的首字母转换为大写 |
| lcfirst |字符串的第一个字符小写 |
| strpos |字符串首次出现的位置 |
| substr |返回字符串的子串 |
|  rtrim(string $str [, string $character_mask ])  |删除字符串末端的空白字符（或者其他字符） |
|preg_replace|执行一个正则表达式的搜索和替换|
|返回值  |处理后的字符串 |

二:数组相关操作

| 函数名| 描述 | 
| ------ | ------ | ------ |
|  array_change_key_case(array,case) |将数组的所有的键都转换为大写字母或小写字母。 |
|  pathinfo(path,options) |以数组的形式返回文件路径的信息。 |
|  parse_ini_file(file,process_sections) |解析一个配置文件，并以数组的形式返回其中的设置. |
|  array_merge(array1,array2,array3...){}|把两个数组合并为一个数组. |
| array_shift |将数组开头的单元移出数组 |
| array_pop |弹出数组最后一个单元（出栈） |
| array_unshift|数组开头插入一个或多个单元|
| array_push |弹出将一个或多个单元压入数组的末尾（入栈）|
| explode |使用一个字符串分割另一个字符串,返回的是数组|
| list |把数组中的值赋给一组变量|
|返回值  |处理后的数组 |
三:其他
| 函数名| 描述 | 
| ------ | ------ | ------ |
|  strip_tags() |剥去字符串中的 HTML、XML 以及 PHP 的标签。 |
|  is_callable() |用于检测函数在当前环境中是否可调用。 |
|  define('APP_PATH', __DIR__ . '/../application/')|定义一个常量。 |
|  is_null|检测变量是否为 NULL。 |
| isset |isset() 函数用于检测变量是否已设置并且非 NULL,废除则用unset |
|   is_file( $pathname ) |判断给定文件名是否为一个正常的文件。 |
|   putenv ($setting) |设置环境变量的值。 用getenv可以获得环境值,用getenv可以获得环境值|
