<?php

namespace Anubis\BladeComponent;

use Illuminate\Support\Facades\Session;

class Blade
{
    protected $sessionKey = 'anubis.active';
    protected $deactiveSessionKey = 'anubis.deactive';

    public function getToken(): string
    {
        return Session::get($this->sessionKey, hash('sha512', random_bytes(16)));
    }

    public function setActiveData($key, $data)
    {
        Session::put("{$this->sessionKey}.{$key}", $data);
    }

    public function getActiveData($key)
    {
        return Session::get("{$this->sessionKey}.{$key}", []);
    }

    public function markUsed($key)
    {
        Session::forget("{$this->sessionKey}.{$key}");
        Session::put("{$this->deactiveSessionKey}.{$key}", true);
    }
}