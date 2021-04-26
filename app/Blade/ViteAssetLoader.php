<?php


namespace App\Blade;

use Psr\SimpleCache\CacheInterface;

class ViteAssetLoader
{
    private ?array $manifestData = null;
    private bool $isDev;
    private string $manifest;
    private CacheInterface $cache;

    public function __construct(bool $isDev, string $manifest, CacheInterface $cache)
    {
        $this->isDev = $isDev;
        $this->manifest = $manifest;
        $this->cache = $cache;
    }

    public function asset(string $url, array $deps): string
    {
        //si nous sommes dans l'environnemetn de dev alors
        if ($this->isDev) {
            return $this->assetDev($url, $deps);
        } else {
            return $this->assetProd($url);
        }
    }

    public function assetDev(string $url, array $deps): string
    {
        $base = 'http://localhost:3000/assets';
        $html = <<<HTML
 <script type="module" src="{$base}/@vite/client"></script>
 HTML;

        if (in_array('react', $deps)) {
            $html .= <<< HTML
<script type="module">
import RefreshRuntime from "{$base}/@react-refresh"
RefreshRuntime.injectIntoGlobalHook(window)
window.\$RefreshReg\$ = () => {}
window.\$RefreshSig\$ = () => (type) => type
window.__vite_plugin_react_preamble_installed__ = true
</script>
HTML;
        }

        $html .= <<<HTML
<script src="{$base}{$url}" type="module" defer></script>
HTML;

        return $html;
    }

    public function assetProd(string $url): string
    {
        if (!$this->manifestData) {
            $manifest = $this->cache->get('vite_manifest', null);

            if($manifest === null){
                $manifest = json_decode(file_get_contents($this->manifest), true);
                $this->cache->set('vite_manifest', $manifest);
            }
            $this->manifestData = $manifest;
        }
        $file = $manifest[trim($url, '/')]['file'] ?? null;
        $cssFiles = $manifest[trim($url, '/')]['css'] ?? [];
        if ($file === null){
            return '';
        }
        $html = <<<HTML
<script src="/assets/{$file}" type="module" defer></script>
HTML;

        foreach ($cssFiles as $css){
            $html .= <<<HTML
<link rel="stylesheet" href="/assets/{$css}" media="screen"/>
HTML;

        }
        return $html;
    }
}
