<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DateTime;
use App\Product;

class XMLSitemap extends Command {
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:xmlsitemap';

    /**
    * The console command description.
    *
    * @var string
    */
    protected $description = 'Generation Sitemap.xml';//описание нашей команды

    /**
    * Create a new command instance.
    *
    * @return void
    */
    public function __construct()
    {
        parent::__construct();
    }

    /**
    * Execute the console command.
    *
    * @return mixed
    */
    public function fire()
    {
        //тут тело как-раз нашей функции
        $site_url = "http://bulavka.org";//уберите лишние пробелы
        $base = '<?xml version="1.0" encoding="UTF-8"?>
        <urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
        </urlset>';
        $xmlbase = new \SimpleXMLElement($base);
        $row  = $xmlbase->addChild("url");
        $row->addChild("loc",$site_url);
        $row->addChild("lastmod",date("c"));
        $row->addChild("changefreq","monthly");
        $row->addChild("priority","1");
        //выбираем нужные нам записи из базы данных
        foreach (Product::all() as $result) {
            $row  = $xmlbase->addChild("url");
            $row->addChild("loc",$site_url.'/product/'.$result->id);
            $date = new DateTime($result->created_at);
            $row->addChild("lastmod",$date->format("Y-m-d\TH:i:sP"));
            $row->addChild("changefreq","monthly");
            $row->addChild("priority","1");
        }
        //укажите путь куда нужно сохранять файл
        $xmlbase->saveXML("sitemap.xml");
    }
}