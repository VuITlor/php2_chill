<?php
// Router.php
class Router {
    private $routes = [];
    private $middlewares = [];
    
    public function addRoute($path, $handler, $middlewares = []) {
        $this->routes[$path] = [
            'handler' => $handler,
            'middlewares' => $middlewares
        ];
    }
    
    public function addMiddleware($middleware) {
        $this->middlewares[] = $middleware;
    }
    
    public function dispatch() {
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        // Xác định base path (ví dụ: /php2/)
        $basePath = '/php2/';
        
        // Kiểm tra nếu $path bắt đầu bằng $basePath
        if (strpos($path, $basePath) === 0) {
            $path = substr($path, strlen($basePath)); // Loại bỏ base path
        }
        
        // Loại bỏ dấu gạch chéo thừa sau khi đã xử lý base path
        $path = trim($path, '/');
        
        // Run global middlewares
        foreach ($this->middlewares as $middleware) {
            if (is_callable($middleware)) {
                $middleware();
            }
        }
    
        foreach ($this->routes as $routePath => $route) {
            $routePath = trim($routePath, '/'); // Loại bỏ dấu gạch chéo thừa
            $pattern = preg_replace('/\{([a-zA-Z0-9_]+)\}/', '([^/]+)', $routePath);
            $pattern = '@^' . $pattern . '$@';
            if (preg_match($pattern, $path, $matches)) {
                foreach ($route['middlewares'] as $middleware) {
                    if (is_callable($middleware)) {
                        $middleware();
                    }
                }
                array_shift($matches);
                call_user_func_array($route['handler'], $matches);
                return;
            }
        }
    
        header("HTTP/1.0 404 Not Found");
        require_once 'view/notfound.php';
    }
}