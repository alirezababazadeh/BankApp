<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ConvertNumberFormatMiddleware
{
    protected array $except = [];

    public function handle(Request $request, Closure $next): mixed
    {
        $except = array_merge($this->except, array_slice(func_get_args(), 2));
        $request->merge($this->process($request->except($except)));
        return $next($request);
    }

    protected function process(array $data): array
    {
        array_walk_recursive(
            $data,
            function (&$value, $key) {
                $value = $this->processValue($value);
            }
        );

        return $data;
    }

    protected function processValue(mixed $value): mixed
    {
        if (is_string($value)) {
            $newNumbers = range(0, 9);
            $persianDecimal = array('&#1776;', '&#1777;', '&#1778;', '&#1779;', '&#1780;', '&#1781;', '&#1782;', '&#1783;', '&#1784;', '&#1785;');
            $arabicDecimal = array('&#1632;', '&#1633;', '&#1634;', '&#1635;', '&#1636;', '&#1637;', '&#1638;', '&#1639;', '&#1640;', '&#1641;');
            $arabic = array('٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩');
            $persian = array('۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹');

            $value = str_replace($persianDecimal, $newNumbers, $value);
            $value = str_replace($arabicDecimal, $newNumbers, $value);
            $value = str_replace($arabic, $newNumbers, $value);
            $value = str_replace($persian, $newNumbers, $value);
        }

        return $value;
    }
}
