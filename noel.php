<?php

    $wishlist = [
        'Calixte' => [
            [
                "url" => "https://fr.smallable.com/ceinture-a-outils-plan-toys-111575.html"
            ],
            [
                "url" => "https://fr.smallable.com/boite-a-formes-boitabasic-djeco-130394.html"
            ],
            [
                "url" => "https://fr.smallable.com/fruits-et-legumes-a-decouper-en-bois-set-de-7-vilac-131805.html"
            ],
            [
                "url" => "https://fr.smallable.com/jeu-empilable-en-bois-oiseau-bleu-sebra-111843.html"
            ],
            [
                "url" => "https://fr.smallable.com/banc-a-marteler-en-bois-naturel-3-balles-plan-toys-189735.html"
            ],
            [
                "url" => "https://fr.smallable.com/petit-dejeuner-plan-toys-189737.html"
            ],
            [
                "url" => "https://fr.smallable.com/tour-a-empiler-edvin-en-bois-kid-s-concept-187962.html"
            ],
            [
                "url" => "https://fr.smallable.com/canard-a-pousser-en-bois-vilac-166631.html"
            ],
            [
                "url" => "https://fr.smallable.com/jeu-d-equilibre-ciel-etoile-selecta-167833.html"
            ],
            [
                "url" => "https://fr.smallable.com/costume-de-chef-cuisinier-flexa-128205.html"
            ],
            [
                "url" => "https://fr.smallable.com/arc-en-ciel-en-bois-raduga-grez-189855.html"
            ],
            [
                "url" => "https://fr.smallable.com/cubes-de-construction-neo-set-de-20-pieces-marron-kid-s-concept-199647.html"
            ],
            [
                "url" => "https://fr.smallable.com/set-de-legumes-du-marche-en-bois-raduga-grez-189844.html"
            ],
            [
                "url" => "https://fr.smallable.com/ours-empilable-en-bois-briki-vroom-vroom-154199.html"
            ],
            [
                "url" => "https://fr.smallable.com/mini-tambour-blanc-kid-s-concept-199664.html",
                "important" => true
            ],
            [
                "url" => "https://fr.smallable.com/puzzle-baby-animali-en-bois-djeco-197103.html"
            ],
            [
                "url" => "https://fr.smallable.com/jeu-a-tirer-famille-mammouth-kid-s-concept-135524.html"
            ],
            [
                "url" => "https://www.lesenfantsdudesign.com/cubes-alphabet-blanc-ooh-noo-p8060.html"
            ],
            [
                "url" => "https://fr.smallable.com/poupee-a-habiller-petite-fille-avec-ses-habits-minikane-203040.html",
                "important" => true
            ],
            [
                "url" => "https://www.amara.com/fr/produits/jouet-ordinateur-en-bois",
                "important" => true
            ]
        ]
    ];

    $filename = "cache.json";

?>

<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title>🎄 ☃️ Notre liste de noël 🎁 🎅</title>

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body>
	<div class="container">
        <h1>🎄 ☃️ Notre liste de noël 🎁 🎅</h1>
        <?php
            foreach ($wishlist as $key => $value) {
                ?>
                    <h2><?php echo $key ?></h2>
                <?php
                $json = json_decode(file_exists($filename) ? file_get_contents($filename) : '', true);
                foreach ($value as $item) {
                    $title = null;
                    $image = null;
                    if(isset($json[$item['url']])) {
                        $title = $json[$item['url']]['title'];
                        $image = $json[$item['url']]['image'];
                    } else {
                        $fp = file_get_contents($item['url']);
                        libxml_use_internal_errors(true);
                        $dom_obj = new DOMDocument();
                        $dom_obj->loadHTML('<?xml encoding="utf-8" ?>' . $fp);
                        $title = $dom_obj->getElementsByTagName('title')[0]->nodeValue;
                        foreach($dom_obj->getElementsByTagName('meta') as $meta) {
                            if($meta->getAttribute('property')=='og:image') {
                                $image = $meta->getAttribute('content');
                            }
                        }
                        if($image == null) {
                            foreach($dom_obj->getElementsByTagName('img') as $img) {
                                if($img->getAttribute('itemprop') == 'image') {
                                    $image = $img->getAttribute('src');
                                }
                            }
                        }

                        $json[$item['url']] = array("title" => $title, "image" => $image);
                        file_put_contents($filename, json_encode($json));
                    }                                  
                    ?>
                        <div class="row">
                            <div class="col-3">
                                <img class="img-responsive" style="max-width: 100%;" src="<?php echo $image ?>" />
                            </div>
                            <div class="col-9">
                                <a href="<?php echo $item['url'] ?>" target="_blank"><?php echo (isset($item['important']) ? '❤️ ' : '') . $title ?></a>
                            </div>
                        </div>
                    <?php
                }
            }
        ?>
	</div>

	<script	src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>