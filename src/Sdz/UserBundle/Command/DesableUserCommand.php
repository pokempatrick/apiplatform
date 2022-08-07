<?php
 
// src/Sdz/UserBundle/Command/DesableUser.php
namespace Sdz\UserBundle\Command;
use Sdz\UserBundle\Service\CronAnonyme;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;


/**
* Commande de résiliation d'abonnement pour impayé
*/
class DesableUserCommand extends Command
{
    // the name of the command (the part after "bin/console")
    protected static $defaultName = 'app:desable-user';

    private $cronAnonyme;

    public function __construct(CronAnonyme $cronAnonyme)
    {
        $this->cronAnonyme = $cronAnonyme;

        parent::__construct();
    }

    protected function configure()
    {
         $this
        // the short description shown while running "php bin/console list"
        ->setDescription('Desable all non Admin users.')

        // the full command description shown when running the command with
        // the "--help" option
        ->setHelp('This command allows you to desable all non Admin users...')
    ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // $this->cronAnonyme->desable();
        $output->write('You have desable all non Admin Users');
    }
}
