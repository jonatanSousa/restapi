<?php

namespace updateGeolocationBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;


class CronUpdateGeolocationCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('cron:updateGeolocation')
            ->setDescription('updates post codes from remote UrL')
            ->addArgument('argument', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('update', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $argument = $input->getArgument('argument');

        $em = $this->getContainer()->get('doctrine')->getManager();

        if ($argument == 'update') {

            $url = 'https://raw.githubusercontent.com/centraldedados/codigos_postais/master/data/codigos_postais.csv';

            $content = file_get_contents($url);
            file_put_contents('tmp/codigosPostais.csv', $content);

            if (($handle = fopen('tmp/codigosPostais.csv', 'r')) !== FALSE) {
                $id= 1;

               // $ipTable = new geoIpCountry ();
                while (($data = fgetcsv($handle, 0, ',')) !== FALSE) {

                    $id++;
                    if($data[16] == 'desig_postal'){
                        continue;
                    }

                    $rua = $data[5];
                    // clean empty array indexes to get street name
                    for($index = 6;$index < 12; $index ++)
                        {
                            if ($data[$index] == ''){
                               continue;
                            }
                            $rua .= ' '.$data[$index];
                        }

                    $rua = str_replace('"', "", $rua);

                    $postCode = $data[14].'-'.$data[15];

                    $RAW_QUERY = 'INSERT INTO codigos_postais_moradas  
                        (
                            post_code,
                            city,
                            street
                        ) VALUES (
                            "'.$postCode.'",
                            "'.$data[16].'",
                            "'.$rua.'"
                        )';


                    $statement = $em->getConnection()->prepare($RAW_QUERY);
                    $statement->execute();


                    //this sends to monolog
                    $output->writeln($id.' '.$postCode.' '.$rua."\n");

                    //insert it into memcache and get it after
                }
                fclose($handle);
            }
            unlink ('tmp/codigosPostais.csv');
        }
    }


    protected function saveRow($postCode){

   /*     $em = $this->getDoctrine()->getManager();

        $postCode->ge

        $RAW_QUERY = 'SELECT * FROM my_table where my_table.field = 1 LIMIT 5;';

        $statement = $em->getConnection()->prepare($RAW_QUERY);
        $statement->execute();
*/
    }

}
