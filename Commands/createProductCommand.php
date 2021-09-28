<?php

namespace Commands;

use Includes\FactoryDB;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class createProductCommand extends Command
{
    protected $commandName = 'createProduct';
    protected $commandDescription = "Add New Product";

    protected $commandArgumentName = "name";
    protected $commandArgumentDescription = "Product Name";

    protected $commandOptionPrice = "price"; // should be specified like "php coder createProduct Iphone --price"
    protected $commandOptionPriceDescription = 'Product Price';

    protected $commandOptionRate = "rate"; // should be specified like "php coder createProduct Iphone --rate"
    protected $commandOptionRateDescription = 'Product Rate';

    protected $commandOptionWeight = "weight"; // should be specified like "php coder createProduct Iphone --weight"
    protected $commandOptionWeightDescription = 'Product Weight';


    protected function configure()
    {
        $this
            ->setName($this->commandName)
            ->setDescription($this->commandDescription)
            ->addArgument(
                $this->commandArgumentName,
                InputArgument::OPTIONAL,
                $this->commandArgumentDescription

            )->addOption(
                $this->commandOptionRate,
                null,
                InputArgument::IS_ARRAY | InputArgument::REQUIRED,
                $this->commandOptionRateDescription
            )->addOption(
                $this->commandOptionWeight,
                null,
                InputArgument::IS_ARRAY | InputArgument::REQUIRED,
                $this->commandOptionWeightDescription
            )->addOption(
                $this->commandOptionPrice,
                null,
                InputArgument::IS_ARRAY | InputArgument::REQUIRED,
                $this->commandOptionPriceDescription
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $name = $input->getArgument($this->commandArgumentName);

        $array = array(
            "Item_type" => $name,
            "Item_price" => $input->getOption($this->commandOptionPrice),
            "shipping_rates_id" => $input->getOption($this->commandOptionRate),
            "weight" => $input->getOption($this->commandOptionWeight)
        );
        $model = new FactoryDB();
        $model->insertInto("products", $array);


        $output->writeln($model);
    }
}
