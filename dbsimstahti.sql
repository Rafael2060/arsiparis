/*
SQLyog Community v13.2.1 (64 bit)
MySQL - 10.1.28-MariaDB : Database - dbarsiparis
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `ci_sessions` */

DROP TABLE IF EXISTS `ci_sessions`;

CREATE TABLE `ci_sessions` (
  `id` varchar(128) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  `data` blob NOT NULL,
  KEY `ci_sessions_timestamp` (`timestamp`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `ci_sessions` */

insert  into `ci_sessions`(`id`,`ip_address`,`timestamp`,`data`) values 
('lt5nbi2af3op3abs8aa7gess0o6sulgd','::1',1713711814,'__ci_last_regenerate|i:1713711814;'),
('76kprfhjgjv17ommtduolp18g6gaklqd','::1',1713711819,'__ci_last_regenerate|i:1713711818;'),
('sh36auc4to01advp42f32gpqacnsb1s5','::1',1713714287,'__ci_last_regenerate|i:1713714287;'),
('urt9ml0lf0ibf47ngk3coe8cfkomq800','::1',1713755202,'__ci_last_regenerate|i:1713755117;username|s:6:\"wasbir\";role_id|s:1:\"1\";'),
('s4q2fm6q7cqksp1evcd9o4ops9ja8ud2','::1',1713757290,'__ci_last_regenerate|i:1713757003;username|s:6:\"wasbir\";role_id|s:1:\"1\";'),
('07utmili1gc6tqd3oatp08heh5h04tt7','::1',1713757789,'__ci_last_regenerate|i:1713757537;username|s:6:\"wasbir\";role_id|s:1:\"1\";'),
('jfndb0mu5qj63g43avm56ev8jcb13kci','::1',1713759170,'__ci_last_regenerate|i:1713758882;username|s:6:\"wasbir\";role_id|s:1:\"1\";'),
('16r0gmkp7o7hiblt3j7jam79n0ff6mqd','::1',1713759509,'__ci_last_regenerate|i:1713759226;role|s:13:\"Administrator\";token|s:10:\"IBk53biWDm\";username|s:6:\"wasbir\";role_id|s:1:\"1\";'),
('ssvcjm30gab505a2afs1keo7g2go6n97','::1',1713759542,'__ci_last_regenerate|i:1713759263;username|s:6:\"wasbir\";role_id|s:1:\"1\";role|s:13:\"Administrator\";token|s:10:\"kkeVbJv9PI\";'),
('hf6mniacuq9ci07v3povh543irsmgd8t','::1',1713759851,'__ci_last_regenerate|i:1713759554;role|s:13:\"Administrator\";token|s:10:\"cjVOrbUCAG\";username|s:6:\"wasbir\";name|s:12:\"WASBIR REFLI\";role_id|s:1:\"1\";'),
('2nehf2vfgvu1q5ba7bu88imlrhinlaj5','::1',1713759704,'__ci_last_regenerate|i:1713759564;username|s:6:\"wasbir\";role_id|s:1:\"1\";role|s:13:\"Administrator\";token|s:10:\"ymH99BpOsV\";message|s:215:\"<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">Sesi anda telah habis, silahkan login ulang.<button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\" aria-label=\"Close\"></button></div>\";__ci_vars|a:1:{s:7:\"message\";s:3:\"old\";}'),
('6k2vfginfsivvkr5e6a5l6e0frjun1ec','::1',1713760070,'__ci_last_regenerate|i:1713759902;role|s:13:\"Administrator\";token|s:10:\"dQCKZ8H9Gc\";name|s:12:\"WASBIR REFLI\";username|s:6:\"wasbir\";role_id|s:1:\"1\";'),
('ankjkk9g5hg7tahicg0k3jnc7cduj1dh','::1',1713760260,'__ci_last_regenerate|i:1713760260;role|s:13:\"Administrator\";token|s:10:\"dQCKZ8H9Gc\";name|s:12:\"WASBIR REFLI\";username|s:6:\"wasbir\";role_id|s:1:\"1\";'),
('o0jd32d4d116vp5vb4se76ccrn8umpt9','::1',1713761026,'__ci_last_regenerate|i:1713761026;role|s:13:\"Administrator\";token|s:10:\"dQCKZ8H9Gc\";name|s:12:\"WASBIR REFLI\";username|s:6:\"wasbir\";role_id|s:1:\"1\";'),
('993vptuc1dek3r6fkddg7lmbg8elc9sq','::1',1713762002,'__ci_last_regenerate|i:1713761719;role|s:13:\"Administrator\";token|s:10:\"dQCKZ8H9Gc\";name|s:12:\"WASBIR REFLI\";username|s:6:\"wasbir\";role_id|s:1:\"1\";'),
('kpt5nuvqfmvvkou01f87tt1kbco9kkcc','::1',1713762283,'__ci_last_regenerate|i:1713762021;role|s:13:\"Administrator\";token|s:10:\"dQCKZ8H9Gc\";name|s:12:\"WASBIR REFLI\";username|s:6:\"wasbir\";role_id|s:1:\"1\";'),
('h0oqtnstplliheofvje4h6mufajkc20f','::1',1713762709,'__ci_last_regenerate|i:1713762414;role|s:13:\"Administrator\";token|s:10:\"dQCKZ8H9Gc\";name|s:12:\"WASBIR REFLI\";username|s:6:\"wasbir\";role_id|s:1:\"1\";'),
('ku1jkprdo789cpcjt4encm7jptsgqu6j','::1',1713763186,'__ci_last_regenerate|i:1713763048;role|s:13:\"Administrator\";token|s:10:\"dQCKZ8H9Gc\";name|s:12:\"WASBIR REFLI\";username|s:6:\"wasbir\";role_id|s:1:\"1\";'),
('nilfr5urc301bbfurdiek9s4qludljlc','::1',1713763697,'__ci_last_regenerate|i:1713763492;role|s:13:\"Administrator\";token|s:10:\"dQCKZ8H9Gc\";name|s:12:\"WASBIR REFLI\";username|s:6:\"wasbir\";role_id|s:1:\"1\";'),
('qh85eogrq509fvphrlmtqinphtenpje3','::1',1713764092,'__ci_last_regenerate|i:1713763806;role|s:13:\"Administrator\";token|s:10:\"dQCKZ8H9Gc\";name|s:12:\"WASBIR REFLI\";username|s:6:\"wasbir\";role_id|s:1:\"1\";'),
('bjsdso2k8vkv82s8voamg3js94khfvu8','::1',1713764294,'__ci_last_regenerate|i:1713764131;role|s:13:\"Administrator\";token|s:10:\"dQCKZ8H9Gc\";name|s:12:\"WASBIR REFLI\";username|s:6:\"wasbir\";role_id|s:1:\"1\";'),
('s15rk16851g6mkgjdpgvi07asohkc1c3','::1',1713764976,'__ci_last_regenerate|i:1713764677;role|s:13:\"Administrator\";token|s:10:\"dQCKZ8H9Gc\";name|s:12:\"WASBIR REFLI\";username|s:6:\"wasbir\";role_id|s:1:\"1\";'),
('bgqejfk32jhp7cmrhograqeogvlnmotf','::1',1713764980,'__ci_last_regenerate|i:1713764978;role|s:13:\"Administrator\";token|s:10:\"dQCKZ8H9Gc\";name|s:12:\"WASBIR REFLI\";username|s:6:\"wasbir\";role_id|s:1:\"1\";'),
('13krmk5ks35kb0gudql94n43i1dtottq','::1',1713790562,'__ci_last_regenerate|i:1713790530;username|s:6:\"wasbir\";name|s:12:\"WASBIR REFLI\";role_id|s:1:\"1\";role|s:13:\"Administrator\";token|s:10:\"gjbf6eTex4\";'),
('185t62sgkspll9dmfkh68cl49nch2saj','::1',1713791885,'__ci_last_regenerate|i:1713791756;username|s:6:\"wasbir\";name|s:12:\"WASBIR REFLI\";role_id|s:1:\"1\";role|s:13:\"Administrator\";token|s:10:\"gjbf6eTex4\";'),
('f44oc420jv73e0ubdklcg8p7f3hse1k4','::1',1713792351,'__ci_last_regenerate|i:1713792075;username|s:6:\"wasbir\";name|s:12:\"WASBIR REFLI\";role_id|s:1:\"1\";role|s:13:\"Administrator\";token|s:10:\"gjbf6eTex4\";'),
('ftlo2k2p1c1timj6qr6gvn778dqbercb','::1',1713792899,'__ci_last_regenerate|i:1713792635;username|s:6:\"wasbir\";name|s:12:\"WASBIR REFLI\";role_id|s:1:\"1\";role|s:13:\"Administrator\";token|s:10:\"gjbf6eTex4\";'),
('u1nba7opmul45tded24k9gqdf8n5n1rj','::1',1713793291,'__ci_last_regenerate|i:1713793166;username|s:6:\"wasbir\";name|s:12:\"WASBIR REFLI\";role_id|s:1:\"1\";role|s:13:\"Administrator\";token|s:10:\"gjbf6eTex4\";'),
('v3jhkhn37giln23kpl8dq9qk5emdd0fp','::1',1713793678,'__ci_last_regenerate|i:1713793530;username|s:6:\"wasbir\";name|s:12:\"WASBIR REFLI\";role_id|s:1:\"1\";role|s:13:\"Administrator\";token|s:10:\"gjbf6eTex4\";'),
('7864jg58dlcta1mu6qr1fpqk7o4afg3l','::1',1713794137,'__ci_last_regenerate|i:1713793851;username|s:6:\"wasbir\";name|s:12:\"WASBIR REFLI\";role_id|s:1:\"1\";role|s:13:\"Administrator\";token|s:10:\"gjbf6eTex4\";'),
('7k9f2dvc3c25r69b0f9j5qdovse10b4p','::1',1713794540,'__ci_last_regenerate|i:1713794282;username|s:6:\"wasbir\";name|s:12:\"WASBIR REFLI\";role_id|s:1:\"1\";role|s:13:\"Administrator\";token|s:10:\"gjbf6eTex4\";'),
('8eup691n4mf3sg49u7dlk4svg7qb0aur','::1',1713794976,'__ci_last_regenerate|i:1713794679;username|s:6:\"wasbir\";name|s:12:\"WASBIR REFLI\";role_id|s:1:\"1\";role|s:13:\"Administrator\";token|s:10:\"gjbf6eTex4\";'),
('dp57m4qp4quati55ioa0k7noi739t04u','::1',1713795255,'__ci_last_regenerate|i:1713794984;username|s:6:\"wasbir\";name|s:12:\"WASBIR REFLI\";role_id|s:1:\"1\";role|s:13:\"Administrator\";token|s:10:\"gjbf6eTex4\";'),
('tg9rjd5ouumcu7q5ltf562r5c0ddksjn','::1',1713795539,'__ci_last_regenerate|i:1713795319;username|s:6:\"wasbir\";name|s:12:\"WASBIR REFLI\";role_id|s:1:\"1\";role|s:13:\"Administrator\";token|s:10:\"gjbf6eTex4\";'),
('46c4d1oct1ermkoj797jmfgtv26bl3iu','::1',1713795834,'__ci_last_regenerate|i:1713795670;username|s:6:\"wasbir\";name|s:12:\"WASBIR REFLI\";role_id|s:1:\"1\";role|s:13:\"Administrator\";token|s:10:\"gjbf6eTex4\";'),
('3613s6jn900m64it2kp2bl5gkbe8t01c','::1',1713841742,'__ci_last_regenerate|i:1713841550;username|s:6:\"wasbir\";name|s:12:\"WASBIR REFLI\";role_id|s:1:\"1\";role|s:13:\"Administrator\";token|s:10:\"BjDFJqJtKI\";'),
('vqtsuhglbnd0jvtnr9vedt7ern82absn','::1',1713842153,'__ci_last_regenerate|i:1713841877;username|s:6:\"wasbir\";name|s:12:\"WASBIR REFLI\";role_id|s:1:\"1\";role|s:13:\"Administrator\";token|s:10:\"BjDFJqJtKI\";'),
('hlbjlaacd842a51323fqvpa2r5dadbsd','::1',1713842239,'__ci_last_regenerate|i:1713842239;username|s:6:\"wasbir\";name|s:12:\"WASBIR REFLI\";role_id|s:1:\"1\";role|s:13:\"Administrator\";token|s:10:\"BjDFJqJtKI\";'),
('18n2bod8tvqnoum2eksascvpjrfkgple','::1',1713844789,'__ci_last_regenerate|i:1713844502;username|s:6:\"wasbir\";name|s:12:\"WASBIR REFLI\";role_id|s:1:\"1\";role|s:13:\"Administrator\";token|s:10:\"BjDFJqJtKI\";'),
('20sfihq645u6h58h48eemjvu1c2t4dlh','::1',1713844971,'__ci_last_regenerate|i:1713844877;username|s:6:\"wasbir\";name|s:12:\"WASBIR REFLI\";role_id|s:1:\"1\";role|s:13:\"Administrator\";token|s:10:\"BjDFJqJtKI\";'),
('43771j1flcrvqlug79574vn10ea57cd4','::1',1713852385,'__ci_last_regenerate|i:1713852119;username|s:6:\"wasbir\";name|s:12:\"WASBIR REFLI\";role_id|s:1:\"1\";role|s:13:\"Administrator\";token|s:10:\"CBillsL6aw\";'),
('mdknfvcbce4rcuib5diusl57ii9stehh','::1',1713852732,'__ci_last_regenerate|i:1713852445;username|s:6:\"wasbir\";name|s:12:\"WASBIR REFLI\";role_id|s:1:\"1\";role|s:13:\"Administrator\";token|s:10:\"CBillsL6aw\";'),
('pvod10n4288rb0nn8ba546cisllhhp8e','::1',1713853048,'__ci_last_regenerate|i:1713852769;username|s:6:\"wasbir\";name|s:12:\"WASBIR REFLI\";role_id|s:1:\"1\";role|s:13:\"Administrator\";token|s:10:\"CBillsL6aw\";'),
('16pohcotuonlopeve26p31hgc653van4','::1',1713853371,'__ci_last_regenerate|i:1713853073;username|s:6:\"wasbir\";name|s:12:\"WASBIR REFLI\";role_id|s:1:\"1\";role|s:13:\"Administrator\";token|s:10:\"CBillsL6aw\";'),
('fs5o3uhemhbr1qaslah6399av5p39018','::1',1713853674,'__ci_last_regenerate|i:1713853387;username|s:6:\"wasbir\";name|s:12:\"WASBIR REFLI\";role_id|s:1:\"1\";role|s:13:\"Administrator\";token|s:10:\"CBillsL6aw\";'),
('8ivb5ocs4g8bifl4p7tlijbls9hpf0j6','::1',1713853896,'__ci_last_regenerate|i:1713853703;username|s:6:\"wasbir\";name|s:12:\"WASBIR REFLI\";role_id|s:1:\"1\";role|s:13:\"Administrator\";token|s:10:\"CBillsL6aw\";'),
('71ck8s10utuk6gravq4473617i463m7p','::1',1713859076,'__ci_last_regenerate|i:1713858871;username|s:6:\"wasbir\";name|s:12:\"WASBIR REFLI\";role_id|s:1:\"1\";role|s:13:\"Administrator\";token|s:10:\"CBillsL6aw\";'),
('2ndalpbf903vb0b8v06b7m5qk430q9j9','::1',1713859441,'__ci_last_regenerate|i:1713859441;username|s:6:\"wasbir\";name|s:12:\"WASBIR REFLI\";role_id|s:1:\"1\";role|s:13:\"Administrator\";token|s:10:\"CBillsL6aw\";'),
('5327pgjtchi7i19kuvikluvu97gss84o','::1',1713860476,'__ci_last_regenerate|i:1713860406;username|s:6:\"wasbir\";name|s:12:\"WASBIR REFLI\";role_id|s:1:\"1\";role|s:13:\"Administrator\";token|s:10:\"CBillsL6aw\";'),
('37f45lcio2kc2b4s6uav631lm95it27p','::1',1713860982,'__ci_last_regenerate|i:1713860731;username|s:6:\"wasbir\";name|s:12:\"WASBIR REFLI\";role_id|s:1:\"1\";role|s:13:\"Administrator\";token|s:10:\"CBillsL6aw\";'),
('g19f4dbqsdk428ltb5fks7fdhlh9cvra','::1',1713861306,'__ci_last_regenerate|i:1713861039;username|s:6:\"wasbir\";name|s:12:\"WASBIR REFLI\";role_id|s:1:\"1\";role|s:13:\"Administrator\";token|s:10:\"CBillsL6aw\";'),
('r31f79audookbkmr32ho6ag9llna4ggt','::1',1713861610,'__ci_last_regenerate|i:1713861553;username|s:6:\"wasbir\";name|s:12:\"WASBIR REFLI\";role_id|s:1:\"1\";role|s:13:\"Administrator\";token|s:10:\"CBillsL6aw\";'),
('hhl1hrq5ov36b807aqp8kbogus9fv7fn','::1',1713862721,'__ci_last_regenerate|i:1713862427;username|s:6:\"wasbir\";name|s:12:\"WASBIR REFLI\";role_id|s:1:\"1\";role|s:13:\"Administrator\";token|s:10:\"CBillsL6aw\";'),
('tsi7lao1b46vrkqgsgfjhkovkgct3b3f','::1',1713862951,'__ci_last_regenerate|i:1713862737;username|s:6:\"wasbir\";name|s:12:\"WASBIR REFLI\";role_id|s:1:\"1\";role|s:13:\"Administrator\";token|s:10:\"CBillsL6aw\";'),
('t0esvl51uk7vkbfn6ou1i7b1vrbp0bgc','::1',1713863185,'__ci_last_regenerate|i:1713863145;username|s:6:\"wasbir\";name|s:12:\"WASBIR REFLI\";role_id|s:1:\"1\";role|s:13:\"Administrator\";token|s:10:\"CBillsL6aw\";'),
('7n1k2tvp7l6pl210dvtkatva98po3omr','::1',1713863510,'__ci_last_regenerate|i:1713863502;username|s:6:\"wasbir\";name|s:12:\"WASBIR REFLI\";role_id|s:1:\"1\";role|s:13:\"Administrator\";token|s:10:\"CBillsL6aw\";'),
('mrtj1qhbccbsdkkfqt2eut75ff44tlsb','::1',1713866039,'__ci_last_regenerate|i:1713865792;username|s:6:\"wasbir\";name|s:12:\"WASBIR REFLI\";role_id|s:1:\"1\";role|s:13:\"Administrator\";token|s:10:\"CBillsL6aw\";'),
('08kqq6olg8u3om2gjc4fqold8hfvu4mc','::1',1713866424,'__ci_last_regenerate|i:1713866127;username|s:6:\"wasbir\";name|s:12:\"WASBIR REFLI\";role_id|s:1:\"1\";role|s:13:\"Administrator\";token|s:10:\"CBillsL6aw\";'),
('3stmibodidek1e3fub5pc6m6j0p9ocgb','::1',1713866820,'__ci_last_regenerate|i:1713866531;username|s:6:\"wasbir\";name|s:12:\"WASBIR REFLI\";role_id|s:1:\"1\";role|s:13:\"Administrator\";token|s:10:\"CBillsL6aw\";'),
('9ivv81574aigutovi12tibftao8jgreo','::1',1713866862,'__ci_last_regenerate|i:1713866843;username|s:6:\"wasbir\";name|s:12:\"WASBIR REFLI\";role_id|s:1:\"1\";role|s:13:\"Administrator\";token|s:10:\"CBillsL6aw\";'),
('0ajhpo9ma2qgj5smtfe97m5mns5rsmqa','::1',1713867557,'__ci_last_regenerate|i:1713867320;username|s:6:\"wasbir\";name|s:12:\"WASBIR REFLI\";role_id|s:1:\"1\";role|s:13:\"Administrator\";token|s:10:\"CBillsL6aw\";'),
('u124lbmvv2egvtnjcibia5id9s79iia4','::1',1713867903,'__ci_last_regenerate|i:1713867634;username|s:6:\"wasbir\";name|s:12:\"WASBIR REFLI\";role_id|s:1:\"1\";role|s:13:\"Administrator\";token|s:10:\"CBillsL6aw\";'),
('fd0ac6151flp187m4p2ns38nuvnmtfts','::1',1713868577,'__ci_last_regenerate|i:1713868287;username|s:6:\"wasbir\";name|s:12:\"WASBIR REFLI\";role_id|s:1:\"1\";role|s:13:\"Administrator\";token|s:10:\"CBillsL6aw\";'),
('er4neu74j7scjd8jmkcofmkbbj402d3k','::1',1713868844,'__ci_last_regenerate|i:1713868664;username|s:6:\"wasbir\";name|s:12:\"WASBIR REFLI\";role_id|s:1:\"1\";role|s:13:\"Administrator\";token|s:10:\"CBillsL6aw\";'),
('aecqfsf7np781etp01n183sf03d7bus1','::1',1713869092,'__ci_last_regenerate|i:1713869013;username|s:6:\"wasbir\";name|s:12:\"WASBIR REFLI\";role_id|s:1:\"1\";role|s:13:\"Administrator\";token|s:10:\"CBillsL6aw\";'),
('a9osh3rh9lln42sfc73ob3gi5v56f3e2','::1',1713880806,'__ci_last_regenerate|i:1713880751;username|s:6:\"wasbir\";name|s:12:\"WASBIR REFLI\";role_id|s:1:\"1\";role|s:13:\"Administrator\";token|s:10:\"EgwTRBbZqv\";message|s:218:\"<div style=\"width:100%\" class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">Data user sudah diperbarui.<button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\" aria-label=\"Close\"></button></div>\";__ci_vars|a:1:{s:7:\"message\";s:3:\"old\";}'),
('4j5nivr2acu3f16v1laaik6iugs2tnn3','::1',1713883345,'__ci_last_regenerate|i:1713883049;username|s:6:\"wasbir\";name|s:12:\"WASBIR REFLI\";role_id|s:1:\"1\";role|s:13:\"Administrator\";token|s:10:\"EgwTRBbZqv\";'),
('89lk8bt2em2h025p420g3ma8lk63qjnp','::1',1713883643,'__ci_last_regenerate|i:1713883353;username|s:6:\"wasbir\";name|s:12:\"WASBIR REFLI\";role_id|s:1:\"1\";role|s:13:\"Administrator\";token|s:10:\"EgwTRBbZqv\";'),
('jbccqpsvkqnshkk2cccvbv5mauc9gt72','::1',1713883814,'__ci_last_regenerate|i:1713883664;username|s:6:\"wasbir\";name|s:12:\"WASBIR REFLI\";role_id|s:1:\"1\";role|s:13:\"Administrator\";token|s:10:\"EgwTRBbZqv\";'),
('pckg7bi52ci9o65afq2cmv48d4pef7bt','::1',1713884437,'__ci_last_regenerate|i:1713884322;username|s:6:\"wasbir\";name|s:12:\"WASBIR REFLI\";role_id|s:1:\"1\";role|s:13:\"Administrator\";token|s:10:\"EgwTRBbZqv\";message|s:221:\"<div style=\"width:100%\" class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">Data user baru sudah disimpan.<button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\" aria-label=\"Close\"></button></div>\";__ci_vars|a:1:{s:7:\"message\";s:3:\"old\";}'),
('2na9p6tutiopeek0qjtrf2v6dc4h9glu','::1',1714096236,'__ci_last_regenerate|i:1714096216;username|s:6:\"wasbir\";name|s:12:\"WASBIR REFLI\";role_id|s:1:\"1\";role|s:13:\"Administrator\";token|s:10:\"r20BPdvgFP\";');

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `username` varchar(30) DEFAULT NULL,
  `email` varchar(128) NOT NULL,
  `image` varchar(128) NOT NULL,
  `password` varchar(256) NOT NULL,
  `role_id` int(11) NOT NULL,
  `is_active` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

/*Data for the table `user` */

insert  into `user`(`id`,`name`,`username`,`email`,`image`,`password`,`role_id`,`is_active`,`date_created`) values 
(13,'WASBIR REFLI','wasbir','wasbir@gmail.com','1.jpg','$2y$10$klzsqGBWoN/Sq98pOJR0HOYVBHBRQncVxHMPBHW9q5dYKDbvNcWl.',1,1,'2024-04-19 17:33:31'),
(14,'Ida','ida','ida@gmail.com','2.jpg','$2y$10$5z7Icb8YiEWdnOiCJCIz1.bA3hhDggtsl76fsa/2xUHdUZQ6ZmSFW',1,1,'2024-04-22 10:38:07'),
(15,'Staff-Andi','staff','staff@gmail','3.jpg','$2y$10$rD0RFgomnndJJDboZZZwZerkqfWedMDUCRgMFPvPv1kZm76kOS1ey',2,1,'2024-04-22 10:39:03'),
(16,'Kaurmintu-Beni','kaurmintu','kaurmintu@gmail.com','4.jpg','$2y$10$W7zPr7V3XtcFrEGG7rOqu.KWJtMBOr81K2xTburxI8mmCDcCu6gVW',3,1,'2024-04-22 10:39:40'),
(17,'Kasattahti-Cindy','kasattahti','kasattahti@gmail.com','5.jpg','$2y$10$H2qTFBjsepRwCK3xPNnCZueyvfxgRzgYsKtpwyC/KDQoBlZ6P2Ybi',4,1,'2024-04-22 10:40:56'),
(18,'Sekretariat-Berliana','sekretariat','sekretaria@gmal.com','6.jpg','$2y$10$uOME04ET3TZ4ZJrr1THtquwjeHqeuAjYwLD4Pl6.yRPJvYXT2ZiCW',5,1,'2024-04-22 10:41:38'),
(20,'Kapolres-Ferry','kapolres','kapolres@gmail.com','','',6,0,'2024-04-23 22:00:37');

/*Table structure for table `user_access_menu` */

DROP TABLE IF EXISTS `user_access_menu`;

CREATE TABLE `user_access_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

/*Data for the table `user_access_menu` */

insert  into `user_access_menu`(`id`,`role_id`,`menu_id`) values 
(1,1,1),
(6,2,2),
(9,1,2),
(10,1,3),
(11,2,3),
(12,1,4),
(13,2,4),
(14,0,0);

/*Table structure for table `user_menu` */

DROP TABLE IF EXISTS `user_menu`;

CREATE TABLE `user_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `user_menu` */

insert  into `user_menu`(`id`,`menu`) values 
(1,'Admin'),
(2,'User'),
(3,'Siak'),
(4,'Arsip');

/*Table structure for table `user_role` */

DROP TABLE IF EXISTS `user_role`;

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role` varchar(128) NOT NULL,
  `keterangan` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `user_role` */

insert  into `user_role`(`id`,`role`,`keterangan`) values 
(1,'Administrator','Administrator Aplikasi'),
(2,'Staff','Staff'),
(3,'Kaurmintu','Kepala Urusan Administrasi dan Ketatausahaan'),
(4,'Kasattahti','Kepala Satuan Perawatan Tahanan dan Barang Bukti'),
(5,'Sekretariat Umum','Sekretariat Umum'),
(6,'Kapolres','Kepala Kepolisian Resor');

/*Table structure for table `user_sub_menu` */

DROP TABLE IF EXISTS `user_sub_menu`;

CREATE TABLE `user_sub_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `url` varchar(128) NOT NULL,
  `icon` varchar(128) NOT NULL,
  `is_active` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

/*Data for the table `user_sub_menu` */

insert  into `user_sub_menu`(`id`,`menu_id`,`title`,`url`,`icon`,`is_active`) values 
(1,1,'Dashboard','Admin','fas fa-fw fa-tachometer-alt',1),
(2,2,'My Profile','User','fas fa-fw fa-user',1),
(3,2,'Edit Profile','User/edit','fas fa-fw fa-user',1),
(4,1,'Entri Data','User','fas fa-fw fa-user',1),
(5,3,'Menu Management','Menu','fas fa-fw fa-folder',1),
(6,3,'Submenu Management','Menu/submenu','fas fa-fw fa-folder-open',1),
(7,1,'Edit Dashboard','Menu','fas fa-fw fa-tachometer-alt',1),
(8,1,'Coba','Coba','fas fa-fw fa-tachometer-alt',1),
(9,1,'Role','Admin/role','fas fa-fw fa-user-tie',1);

/*Table structure for table `user_token` */

DROP TABLE IF EXISTS `user_token`;

CREATE TABLE `user_token` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) DEFAULT NULL,
  `email` varchar(123) DEFAULT NULL,
  `token` varchar(123) DEFAULT NULL,
  `date_created` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

/*Data for the table `user_token` */

insert  into `user_token`(`id`,`username`,`email`,`token`,`date_created`) values 
(13,'wasbir',NULL,'r20BPdvgFP',1714096228);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
