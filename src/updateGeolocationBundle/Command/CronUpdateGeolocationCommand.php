<?php

namespace updateGeolocationBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use ZipArchive;
use Doctrine\Common\Cache\MemcacheCache;


class CronUpdateGeolocationCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('cron:updateGeolocation')
            ->setDescription('...')
            ->addArgument('argument', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('update', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $argument = $input->getArgument('argument');

        if ($argument == 'update') {

            //$url = config('Api.file_url');

            $url = 'http://geolite.maxmind.com/download/geoip/database/GeoIPCountryCSV.zip';

            $content = file_get_contents($url);
            file_put_contents('tmp/tmp.zip', $content);
            $zip = new ZipArchive;
            if ($zip->open("tmp/tmp.zip") === TRUE) {
                $zip->extractTo('tmp');
                $zip->close();
                print_r( 'success File unziped');
            } else {
                return 'it was not possible to unzip the file';
               // exit();
            }


            if (($handle = fopen('tmp/GeoIPCountryWhois.csv', 'r')) !== FALSE) {
                $id= 1;

                print_r('aquii');

               // $ipTable = new geoIpCountry ();
                while (($data = fgetcsv($handle, 1, ',')) !== FALSE) {

                    //insert it into memcache and get it after


                    /*
                     $ipTable = new geoIpCountry ();
                    $hasId = DB::table('geo_ip_countries')->where('id', $id)->first();
                    $ipTable->id = '';
                    $ipTable->min_ip_range = $data [0];
                    $ipTable->max_ip_range = $data [1];
                    $ipTable->min_int_ip = $data [2];
                    $ipTable->max_int_ip = $data [3];
                    $ipTable->country_code = $data [4];
                    $ipTable->country_name = $data [5];
                    $ipTable->created_at = date("Y-m-d H:i:s");
                    $ipTable->updated_at = date("Y-m-d H:i:s");
                    if(isset( $hasId->id )){
                        $ipTable->id = $hasId->id ?? '';
                        $ipTable::where('id', '=', $id)->update([
                            'min_ip_range' => $data [0],
                            'max_ip_range' => $data [1],
                            'min_int_ip' => $data [2],
                            'max_int_ip' => $data [3],
                            'country_code' => $data [4],
                            'country_name' => $data [5],
                            'updated_at' => date("Y-m-d H:i:s")
                        ]);
                        print_r(  $hasId->id  .' updating  '.$data [5]."\n");
                        $id++;
                        continue;
                    }
                    $ipTable->save();*/
                    $id++;
                    print_r($id.' creating  '.$data [5]."\n");
                }
                fclose($handle);
            }
            fopen('tmp/GeoIPCountryWhois.csv', 'w');
            fopen('tmp.zip', 'w');
        }

        $output->writeln('Command result.');
    }

}
