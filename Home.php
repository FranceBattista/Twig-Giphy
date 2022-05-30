<?php
    error_reporting(0);
    require __DIR__ . '/vendor/autoload.php';

    use Twig\Environment;
    use Twig\Loader\FilesystemLoader;
    use GuzzleHttp\Client;

    $loader = new FilesystemLoader(__DIR__ . '/templates');
    $twig = new Environment($loader);

    $data = array();

    $URL = 'https://api.giphy.com/v1/gifs';
    $API_KEY = "WIMeJAjk92pQkdmigi2kDkrdhv2lhTMH";
    $client = new Client([
        'base_uri' => $URL,
        "verify" => false
    ]);
    $Testo = $_GET['text'];
    $response = $client->request(
        'GET', 
        $URL . "/search",[
            'query' => ['api_key' => $API_KEY, "q" => $Testo
                    ]
            ]
    );
    
    $data = json_decode(
        $response->getBody()->getContents(),
        true
    );

    echo $twig->render('home.html.twig', [
        'text' => $Testo,
        'data' => $data['data']
    ]);
?>