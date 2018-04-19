<?php

namespace updateGeolocationBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
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

            $url = 'https://raw.githubusercontent.com/centraldedados/codigos_postais/master/data/codigos_postais.csv';

            $content = file_get_contents($url);
            file_put_contents('tmp/codigosPostais.csv', $content);


            if (($handle = fopen('tmp/codigosPostais.csv', 'r')) !== FALSE) {
                $id= 1;


               // $ipTable = new geoIpCountry ();
                while (($data = fgetcsv($handle, 0, ',')) !== FALSE) {

                    $id++;
                    $rua = $data[5];
                    // clean empty array indexes to get street name
                    for($index = 6;$index < 12; $index ++)
                        {
                            if ($data[$index] == ''){
                               continue;
                            }
                            $rua .= ' '.$data[$index];
                        }

                    $output->writeln($id.' '. $data[14].'-'.$data[15].' '.$data[16].' '.$rua."\n");

                    //insert it into memcache and get it after
                }
                fclose($handle);
            }
        }
        unlink ('tmp/codigosPostais.csv');

    }

}
