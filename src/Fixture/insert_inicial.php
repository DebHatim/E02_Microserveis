<?php

namespace Hatim\Entradas\Fixture;

use Doctrine\ORM\EntityManager;
use Hatim\Entradas\Entity\Admin;
use Hatim\Entradas\Entity\Compra;
use Hatim\Entradas\Entity\Entrada;
use Hatim\Entradas\Entity\Localitzacio;
use Hatim\Entradas\Entity\Espectacle;
use Hatim\Entradas\Entity\Seient;
use Hatim\Entradas\Entity\Usuari;

require __DIR__ . '/../../vendor/autoload.php';
require __DIR__ . '/../bootstrap.php';

/* @var $em EntityManager */

$admin = new Admin();
$admin->setUser("admin");
$admin->setPass("2025@Thos");
$em->persist($admin);

$senseLocalitzacio = new Localitzacio();
$senseLocalitzacio->setNom("Sense Localitzacio");
$senseLocalitzacio->setDireccio('Sense direccio');
$senseLocalitzacio->setCiutat("Cap");
$senseLocalitzacio->setCapacitat(0);
$em->persist($senseLocalitzacio);

$localitzacio01 = new Localitzacio();
$localitzacio01->setNom("Institut Thos I Codina");
$localitzacio01->setDireccio('Riera de Cirera, 57, 08304 Mataró, Barcelona');
$localitzacio01->setCiutat("Mataró");
$localitzacio01->setCapacitat(500);
$em->persist($localitzacio01);

$espectacle01 = new Espectacle();
$espectacle01->setNom('Withered World Tour');
$espectacle01->setPoster('https://static.fnac-static.com/multimedia/Images/FR/NR/31/23/1d/18686769/1540-1/tsp20250214131155/Withered.jpg');
$espectacle01->setHoraInici(new \DateTime('2025-05-19 20:00:00'));
$espectacle01->setHoraFinal(new \DateTime('2025-5-19 23:30:00'));
$espectacle01->setLocalitzacio($localitzacio01);
$em->persist($espectacle01);

$espectacle02 = new Espectacle();
$espectacle02->setNom('The Ruby Experience');
$espectacle02->setPoster('https://cdn-images.dzcdn.net/images/cover/81865df2933eeeb054a317ab161e637a/0x1900-000000-80-0-0.jpg');
$espectacle02->setHoraInici(new \DateTime('2025-5-21 20:00:00'));
$espectacle02->setHoraFinal(new \DateTime('2025-5-21 22:30:00'));
$espectacle02->setLocalitzacio($localitzacio01);
$em->persist($espectacle02);

$seient01 = new Seient();
$seient01->setNumero(1);
$seient01->setFila(1);
$seient01->setTipus('Normal');
$seient01->setLocalitzacio($localitzacio01);
$em->persist($seient01);

$seient02 = new Seient();
$seient02->setNumero(2);
$seient02->setFila(1);
$seient02->setTipus('Normal');
$seient02->setLocalitzacio($localitzacio01);
$em->persist($seient02);

$seient03 = new Seient();
$seient03->setNumero(3);
$seient03->setFila(1);
$seient03->setTipus('Normal');
$seient03->setLocalitzacio($localitzacio01);
$em->persist($seient03);

$entrada01 = new Entrada();
$entrada01->setRef("123456789123456");
$entrada01->setEspectacle($espectacle01);
$entrada01->setPreu(30.00);
$entrada01->setSeient($seient01);
$entrada01->setEstat("Disponible");
$em->persist($entrada01);

$entrada02 = new Entrada();
$entrada02->setRef("323161395451321");
$entrada02->setEspectacle($espectacle01);
$entrada02->setPreu(30.00);
$entrada02->setSeient($seient02);
$entrada02->setEstat("Disponible");
$em->persist($entrada02);

$entrada03 = new Entrada();
$entrada03->setRef("826499215346603");
$entrada03->setEspectacle($espectacle02);
$entrada03->setPreu(35.00);
$entrada03->setSeient($seient03);
$entrada03->setEstat("Disponible");
$em->persist($entrada03);

$usuari01 = new Usuari();
$usuari01->setNom("Hatim");
$usuari01->setEmail('hatim1@gmail.com');
$em->persist($usuari01);

$usuari02 = new Usuari();
$usuari02->setNom("Hatim2");
$usuari02->setEmail('hatim2@gmail.com');
$em->persist($usuari02);

$usuari03 = new Usuari();
$usuari03->setNom("Hatim3");
$usuari03->setEmail('hatim3@gmail.com');
$em->persist($usuari03);

$compra01 = new Compra();
$compra01->setUsuari($usuari01);
$compra01->setMetodePagament('Efectiu');
$compra01->addEntrada($entrada01);
$em->persist($compra01);

$entrada01->setEstat("Venuda");

$em->flush();