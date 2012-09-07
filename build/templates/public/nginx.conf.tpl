root   #phing:paths.public#/;

charset utf-8;
source_charset utf-8;

if (!-e $request_filename){
    rewrite .* /index.php;
}
