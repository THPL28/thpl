<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Exception;
use ReflectionMethod;

class AppController extends Controller
{
    protected $controllerNamespace = "App\\Http\\Controllers\\";
    protected $folder_app = '';

    /**
     * Rota principal: /{pagename} → chama get_index() se existir
     */
    public function index(Request $request, $pagename)
    {
        // Chama get_index() do controller correspondente
        return $this->call($pagename, 'get_index', $request);
    }

    /**
     * Rota GET dinâmica: /{pagename}/{methodname}/{arg1?}
     */
    public function get(Request $request, $pagename, $methodname, $arg1 = null)
    {
        $method = 'get_' . Str::camel($methodname);
        return $this->call($pagename, $method, $request, $arg1 ? [$arg1] : []);
    }

    /**
     * Rota POST/PUT/DELETE dinâmica
     */
    public function post(Request $request, $pagename, $methodname, $arg1 = null)
    {
        $method = 'post_' . Str::camel($methodname);
        return $this->call($pagename, $method, $request, $arg1 ? [$arg1] : []);
    }

    /**
     * Método privado que resolve dinamicamente o controller e chama o método
     */
    private function call(string $pagename, string $method, Request $request, array $params = [])
    {
        $controllerName = Str::studly($pagename) . 'Controller';

        $paths = [
            $this->controllerNamespace . $controllerName,
            $this->controllerNamespace . ($this->folder_app ? $this->folder_app . '\\' : '') . $controllerName,
            $this->controllerNamespace . Str::studly($pagename) . '\\' . $controllerName,
        ];

        $controllerClass = null;
        foreach ($paths as $path) {
            if (class_exists($path)) {
                $controllerClass = $path;
                break;
            }
        }

        if (!$controllerClass) {
            throw new NotFoundHttpException("Controlador '$controllerName' não encontrado.");
        }

        $controller = App::make($controllerClass);

        if (!method_exists($controller, $method)) {
            throw new NotFoundHttpException("Método '$method' não encontrado no controlador '$controllerName'.");
        }

        try {
            return App::call([$controller, $method], array_merge($params, ['request' => $request]));
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro interno ao processar a requisição: ' . $e->getMessage(),
            ], 500);
        }
    }
}
