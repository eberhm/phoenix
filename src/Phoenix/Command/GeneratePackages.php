<?php
namespace Phoenix\Command;

use Phoenix\Config\Normalizer;
use Phoenix\Optimizer\Optimizer;
use Symfony\Component\Console\Command\Command,
    Symfony\Component\Console\Input\InputInterface,
    Symfony\Component\Console\Output\OutputInterface,
    Symfony\Component\Console\Input\InputOption;

class GeneratePackages extends Command
{
    protected function configure()
    {
        $this
            ->setName('generate-packages')
            ->addOption('config', 'c', InputOption::VALUE_OPTIONAL, 'Set the config file');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('<info>Generating packages!</info>');

        $config = $this->getConfig($input, $output);

        if (!$config) {
            return;
        }
        $configNormalizer = new Normalizer();
        $config = $configNormalizer->normalize($config);
        $optimizer = new Optimizer($config);
        $packageNames = array_keys($config['packages']);

        if (count($packageNames)) {
            $output->writeln('<info>Generating packages...</info>');
            try {
                $optimizer->optimizePackages();
            } catch (\Exception $e) {
                $output->writeln('<error>' . $e->getMessage() . '</error>');
                return;
            }
            foreach($packageNames as $packageName) {
                $output->writeln('<info>' . $packageName . '</info>');
            }
            $output->writeln('<info>Packages generated succesfully!</info>');
        } else {
            $output->writeln('<info>No packages configured</info>');
        }
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return mixed|null
     */
    protected function getConfig(InputInterface $input, OutputInterface $output)
    {
        $dialog = $this->getHelperSet()->get('dialog');

        $configFile = $input->getOption('config');

        if (!$configFile) {
            $configFile = $dialog->ask(
                $output,
                '<question>Please enter full path for the config file:</question>'
            );
        }

        if (is_readable($configFile)) {
            $config = require $configFile;
            $output->writeln('<info>Config file found</info>');
        } else {
            $output->writeln('<error>Config file not found: ' . $configFile . '</error>');
            $config = null;
        }

        return $config;
    }
}