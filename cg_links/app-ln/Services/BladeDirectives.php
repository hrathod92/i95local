<?php

namespace App\Services;

use Auth;
use Carbon\Carbon;
use Illuminate\Support\Debug\Dumper;
use Illuminate\View\Compilers\BladeCompiler;
use Illuminate\View\Factory;

class BladeDirectives {

    static protected $filterVars = [
        '__env',
        '__data',
        '__path',
        'app',
        'obLevel',
    ];

    /**
     * @var BladeCompiler
     */
    protected $compiler;

    public function __construct(BladeCompiler $compiler) {
        $this->compiler = $compiler;
    }

    public function register() {

        $directives = [
            'defaults',

            'd',
            'dAll',
            'dAllRaw',

            'dd',
            'ddAll',
            'ddAllRaw',

            'resolve',

            'diffForHumans',
            'formatTimestamp',
            'money',
        ];

        foreach ($directives as $key) {
            $this->registerDirective($key);
        }
    }

    protected function registerDirective($key) {
        $method = 'gen_' . $key;
        $this->compiler->directive($key, [$this, $method]);
    }

    public function gen_defaults($expression) {
        return "<?php extract($expression, EXTR_SKIP); ?>";
    }

    /**
     * yield section or variable with given name, accepts default fallback value of both are not set or empty
     * @param $expression
     * @return string
     */
    public function gen_resolve($expression) {
        return "<?php echo " . get_called_class() . "::resolve(\$__env, get_defined_vars(), $expression); ?>";
    }

    public function gen_dd($expression) {
        return "<?php " . get_called_class() . "::dump($expression); die(1); ?>";
    }

    public function gen_ddAll($expression) {
        return "<?php " . get_called_class() . "::dumpFiltered(get_defined_vars()); die(1); ?>";
    }

    public function gen_ddAllRaw($expression) {
        return "<?php " . get_called_class() . "::dump(get_defined_vars()); die(1); ?>";
    }

    public function gen_d($expression) {
        return "<?php " . get_called_class() . "::dump($expression); ?>";
    }

    public function gen_dAll($expression) {
        return "<?php " . get_called_class() . "::dumpFiltered(get_defined_vars()); ?>";
    }

    public function gen_dAllRaw($expression) {
        return "<?php " . get_called_class() . "::dump(get_defined_vars()); ?>";
    }

    public function gen_diffForHumans($expression) {
        return "<?php echo " . get_called_class() . "::diffForHumans($expression); ?>";
    }

    public function gen_formatTimestamp($expression) {
        return "<?php echo " . get_called_class() . "::formatTimestamp($expression); ?>";
    }

    public function gen_money($expression) {
        return "<?php echo " . get_called_class() . "::money($expression); ?>";
    }

    static public function dumpFiltered($vars) {
        $vars = static::cleanVars($vars);
        static::dump($vars);
    }

    static protected function cleanVars($vars) {
        return array_except($vars, static::$filterVars);
    }

    static public function dump() {
        array_map(function ($x) {
            (new Dumper)->dump($x);
        }, func_get_args());
    }

    static public function resolve(Factory $env, array $defined, $key, $default = '') {
        if ($env->hasSection($key)) {
            $value = $env->yieldContent($key);
        }
        else if (array_key_exists($key, $defined) && trim($defined[$key])) {
            $value = $defined[$key];
        }
        else {
            $value = $default;
        }

        return $value;
    }

    static public function diffForHumans(Carbon $timestamp = null) {
        if (!$timestamp) {
            return;
        }

        return $timestamp->diffForHumans();
    }

    static public function formatTimestamp(Carbon $timestamp = null, $format = 'Y-m-d h:i:s a') {
        if (!$timestamp) {
            return;
        }

        return $timestamp->format($format);
    }

    static public function money($value) {
        return '$' . number_format($value, 2);
    }
}
