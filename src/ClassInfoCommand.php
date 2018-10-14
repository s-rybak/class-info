<?php

namespace App;

use App\ClassInfo;

use Symfony\Component\Console\Command\Command as Command;
use Symfony\Component\Console\Input\InputArgument as InputArgument;
use Symfony\Component\Console\Input\InputInterface as Input;
use Symfony\Component\Console\Output\OutputInterface;

final class ClassInfoCommand extends Command {

	public function configure() {
		$this->setName( 'app:class-info' )
		     ->setDescription( 'Returns class info' )
		     ->addArgument(
			     'name',
			     InputArgument::REQUIRED,
			     'class name'
		     );
	}

	public function execute( Input $input, OutputInterface $output ) {

		try {

			$reflection = new ClassInfo( $input->getArgument( 'name' ) );
			$type       = $reflection->getClassType();
			$properties = $reflection->getPropertiesTypesCount();
			$methods    = $reflection->getMethodsTypesCount();

			$output->writeln( "Class: {$reflection->getShortName()} ({$type} class)" );
			$output->writeln( "Properties: " );
			$output->writeln( "   public: {$properties['public']}" );
			$output->writeln( "   protected: {$properties['protected']}" );
			$output->writeln( "   private: {$properties['private']}" );
			$output->writeln( 'Methods: ' );
			$output->writeln( "   public: {$methods['public']}" );
			$output->writeln( "   protected: {$methods['protected']}" );
			$output->writeln( "   private: {$methods['private']}" );

		} catch ( \ReflectionException $e ) {

			$output->writeln( 'Class load error: ' . $e->getMessage() );

		} catch ( \ErrorException $e ) {

			$output->writeln( 'Error: ' . $e->getMessage() );

		}

	}

}