<?php
namespace app\lib;

class Request{
    protected   $method;
    protected   $uri;
    protected   $input;
    protected   $server;
    protected   $content;
    protected   $ip;
    protected   $status;
    protected   $port;
    protected   $host;
    protected   $allowMethod;
    protected   $url;

    function __construct(){
        $this->server=$_SERVER;
        $this->allowMethod=["post","get","put","delete"];
        $this->method=isset($this->server['REQUEST_METHOD']) ?strtolower($this->server['REQUEST_METHOD']):'get';
        if(!in_array( $this->method,$this->allowMethod)){
            throw new \ErrorException(Response::$statusTexts[Response::HTTP_METHOD_NOT_ALLOWED],Response::HTTP_METHOD_NOT_ALLOWED);
        }
    }

    public function method(){
        return $this->method;
    }
    //获取url
    function url(){
        $url= $this->url=isset($_SERVER['REDIRECT_URL']) ? $_SERVER['REDIRECT_URL'] :'/';
        return trim(trim($url,"/"));
    }



//'REDIRECT_STATUS' => string '200' (length=3)
//'HTTP_HOST' => string 'localhost:8004' (length=14)
//'HTTP_CONNECTION' => string 'keep-alive' (length=10)
//'HTTP_PRAGMA' => string 'no-cache' (length=8)
//'HTTP_CACHE_CONTROL' => string 'no-cache' (length=8)
//'HTTP_UPGRADE_INSECURE_REQUESTS' => string '1' (length=1)
//'HTTP_USER_AGENT' => string 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/68.0.3440.106 Safari/537.36' (length=109)
//'HTTP_ACCEPT' => string 'text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8' (length=85)
//'HTTP_ACCEPT_ENCODING' => string 'gzip, deflate, br' (length=17)
//'HTTP_ACCEPT_LANGUAGE' => string 'zh-CN,zh;q=0.9' (length=14)
//'HTTP_COOKIE' => string 'device=desktop; theme=default; moduleBrowseParam=0; projectTaskOrder=status%2Cid_desc; projectStoryOrder=order_desc; cookie_token=3dc39b2f4b45d7f3062f2aa1a53ce68a60c838560e187cb65c613f1650145260; preBranch=0; bugModule=0; qaBugOrder=id_desc; productBrowseParam=0; productStoryOrder=id_desc; lang=zh-cn; storyModule=0; LOGIN_USERNAME_CRM=U2FsdGVkX1+QN8rwMvTU+pFCSLRV8XdIl8QSlIxp9O4=; LOGIN_PASSWORD_CRM=U2FsdGVkX18sh28WMtWk8H3VpGIHfh5yQg6sYcSJ5es=; user_crm={%22admin_user%22:%22sysadmin%22%2C%22nickname%22:%22%E'... (length=1007)
//'PATH' => string 'C:\ProgramData\Oracle\Java\javapath;C:\Windows\system32;C:\Windows;C:\Windows\System32\Wbem;C:\Windows\System32\WindowsPowerShell\v1.0\;C:\ProgramData\ComposerSetup\bin;D:\Program Files\Java\jdk1.6.0_25\bin;C:\Windows\system32\config\systemprofile\.dnx\bin;C:\Program Files\Microsoft DNX\Dnvm\;C:\Program Files (x86)\Windows Kits\8.1\Windows Performance Toolkit\;C:\Program Files\Microsoft SQL Server\130\Tools\Binn\;C:\Program Files\TortoiseSVN\bin;D:\laragon\bin\php\php-5.6.32-Win32-VC11-x64;C:\Program Files '... (length=704)
//'SystemRoot' => string 'C:\Windows' (length=10)
//'COMSPEC' => string 'C:\Windows\system32\cmd.exe' (length=27)
//'PATHEXT' => string '.COM;.EXE;.BAT;.CMD;.VBS;.VBE;.JS;.JSE;.WSF;.WSH;.MSC' (length=53)
//'WINDIR' => string 'C:\Windows' (length=10)
//'SERVER_SIGNATURE' => string '<address>Apache/2.4.23 (Win32) PHP/5.6.25 Server at localhost Port 8004</address>
//' (length=82)
//'SERVER_SOFTWARE' => string 'Apache/2.4.23 (Win32) PHP/5.6.25' (length=32)
//'SERVER_NAME' => string 'localhost' (length=9)
//'SERVER_ADDR' => string '::1' (length=3)
//'SERVER_PORT' => string '8004' (length=4)
//'REMOTE_ADDR' => string '::1' (length=3)
//'DOCUMENT_ROOT' => string 'E:/webpage/wdgm' (length=15)
//'REQUEST_SCHEME' => string 'http' (length=4)
//'CONTEXT_PREFIX' => string '' (length=0)
//'CONTEXT_DOCUMENT_ROOT' => string 'E:/webpage/wdgm' (length=15)
//'SERVER_ADMIN' => string 'wampserver@wampserver.invalid' (length=29)
//'SCRIPT_FILENAME' => string 'E:/webpage/wdgm/index.php' (length=25)
//'REMOTE_PORT' => string '63508' (length=5)
//'REDIRECT_URL' => string '/index/index' (length=12)
//'GATEWAY_INTERFACE' => string 'CGI/1.1' (length=7)
//'SERVER_PROTOCOL' => string 'HTTP/1.1' (length=8)
//'REQUEST_METHOD' => string 'GET' (length=3)
//'QUERY_STRING' => string '' (length=0)
//'REQUEST_URI' => string '/index/index' (length=12)
//'SCRIPT_NAME' => string '/index.php' (length=10)
//'PHP_SELF' => string '/index.php' (length=10)
//'REQUEST_TIME_FLOAT' => float 1543396978.45
//'REQUEST_TIME' => int 1543396978
//


    public function getClientIps()
    {
        $clientIps = array();
        $ip = $this->server->get('REMOTE_ADDR');

        if (!$this->isFromTrustedProxy()) {
            return array($ip);
        }

        $hasTrustedForwardedHeader = self::$trustedHeaders[self::HEADER_FORWARDED] && $this->headers->has(self::$trustedHeaders[self::HEADER_FORWARDED]);
        $hasTrustedClientIpHeader = self::$trustedHeaders[self::HEADER_CLIENT_IP] && $this->headers->has(self::$trustedHeaders[self::HEADER_CLIENT_IP]);

        if ($hasTrustedForwardedHeader) {
            $forwardedHeader = $this->headers->get(self::$trustedHeaders[self::HEADER_FORWARDED]);
            preg_match_all('{(for)=("?\[?)([a-z0-9\.:_\-/]*)}', $forwardedHeader, $matches);
            $forwardedClientIps = $matches[3];

            $forwardedClientIps = $this->normalizeAndFilterClientIps($forwardedClientIps, $ip);
            $clientIps = $forwardedClientIps;
        }

        if ($hasTrustedClientIpHeader) {
            $xForwardedForClientIps = array_map('trim', explode(',', $this->headers->get(self::$trustedHeaders[self::HEADER_CLIENT_IP])));

            $xForwardedForClientIps = $this->normalizeAndFilterClientIps($xForwardedForClientIps, $ip);
            $clientIps = $xForwardedForClientIps;
        }

        if ($hasTrustedForwardedHeader && $hasTrustedClientIpHeader && $forwardedClientIps !== $xForwardedForClientIps) {
            throw new ConflictingHeadersException('The request has both a trusted Forwarded header and a trusted Client IP header, conflicting with each other with regards to the originating IP addresses of the request. This is the result of a misconfiguration. You should either configure your proxy only to send one of these headers, or configure Symfony to distrust one of them.');
        }

        if (!$hasTrustedForwardedHeader && !$hasTrustedClientIpHeader) {
            return $this->normalizeAndFilterClientIps(array(), $ip);
        }

        return $clientIps;
    }







}