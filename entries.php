<?php
		require_once('/var/www/config.php');
		sro('/Includes/mysql.php');
		sro('/Includes/session.php');
		sro('/Includes/functions.php');

		sro('/PHP5/lib/PHPLang/db.php');
		sro('/PHP5/lib/PHPLang/misc.php');
		sro('/PHP5/lib/PHPLang/templates.php');
?><!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
</head><body><?php
		function add_word($name) {
			global $sql_stmts;
			$w = defaultDB()->searcher()->name($name)->spart("verb")->lang("la")->all();
			if (count($w)) {
				echo "Word seems to be already added: $name<br>";
				return NULL;
			} else {
				echo "Adding word: $name<br>";
				sql_exec($sql_stmts["word_lang,word_name,word_spart->new in words"], ["sss", "la",$name,"verb"]);
				$w = defaultDB()->searcher()->name($name)->spart("verb")->lang("la")->all();
				if (count($w) === 1) {
					$w = $w[0];
					return $w;
				}
			}
		}
		function get_template($conj) {
			return safe_get(0,defaultDB()->searcher()->spart("verb")->name($conj)->only_with_attr(ATTR("template", "true"))->all());
		}
		function run_template2($word,$t,$arg,$ignore) {
			if ($word !== NULL and $t !== NULL)
				run_template($word,"",$t,$arg,$ignore,[],FALSE);
		}
		run_template2(add_word("accūsō"), get_template("1st conjugation (full)"), ['accūs', 'accūsāv', 'accūsāt'], []);
		run_template2(add_word("adiuvō"), get_template("1st conjugation (full)"), ['adiuv', 'adiūv', 'adiūt'], []);
		run_template2(add_word("aedificiō"), get_template("1st conjugation (full)"), ['aedific', 'aedificāv', 'aedificāt'], []);
		run_template2(add_word("ambulō"), get_template("1st conjugation (full)"), ['ambul', 'ambulāv', 'ambulāt'], []);
		run_template2(add_word("amō"), get_template("1st conjugation (full)"), ['am', 'amāv', 'amāt'], []);
		run_template2(add_word("appellō"), get_template("1st conjugation (full)"), ['appell', 'appellāv', 'appellāt'], []);
		run_template2(add_word("appropinquō"), get_template("1st conjugation (full)"), ['appropinqu', 'appropinquāv', 'appropinquāt'], [['passive'], ['supine-2'], ['gerundive']]);
		run_template2(add_word("cantō"), get_template("1st conjugation (full)"), ['cant', 'cantāv', 'cantāt'], []);
		run_template2(add_word("cēlō"), get_template("1st conjugation (full)"), ['cēl', 'cēlāv', 'cēlāt'], []);
		run_template2(add_word("cēnō"), get_template("1st conjugation (full)"), ['cēn', 'cēnāv', 'cēnāt'], []);
		run_template2(add_word("cessō"), get_template("1st conjugation (full)"), ['cess', 'cessāv', 'cessāt'], []);
		run_template2(add_word("clāmō"), get_template("1st conjugation (full)"), ['clām', 'clāmāv', 'clāmāt'], []);
		run_template2(add_word("cōgitō"), get_template("1st conjugation (full)"), ['cōgit', 'cōgitāv', 'cōgitāt'], []);
		run_template2(add_word("convocō"), get_template("1st conjugation (full)"), ['convoc', 'convocāv', 'convocāt'], []);
		run_template2(add_word("cūrō"), get_template("1st conjugation (full)"), ['cūr', 'cūrāv', 'cūrāt'], []);
		run_template2(add_word("dēlectō"), get_template("1st conjugation (full)"), ['dēlect', 'dēlectāv', 'dēlectāt'], []);
		run_template2(add_word("dēmōnstrō"), get_template("1st conjugation (full)"), ['dēmōnstr', 'dēmōnstrāv', 'dēmōnstrāt'], []);
		run_template2(add_word("dēsiderō"), get_template("1st conjugation (full)"), ['dēsider', 'dēsiderāv', 'dēsiderāt'], []);
		run_template2(add_word("dēvorō"), get_template("1st conjugation (full)"), ['dēvor', 'dēvorāv', 'dēvorāt'], []);
		run_template2(add_word("errō"), get_template("1st conjugation (full)"), ['err', 'errāv', 'errāt'], []);
		run_template2(add_word("excitō"), get_template("1st conjugation (full)"), ['excit', 'excitāv', 'excitāt'], []);
		run_template2(add_word("exclāmō"), get_template("1st conjugation (full)"), ['exclām', 'exclāmāv', 'exclāmāt'], []);
		run_template2(add_word("explicō"), get_template("1st conjugation (full)"), ['explic', 'explicāv', 'explicāt'], []);
		run_template2(add_word("exspectō"), get_template("1st conjugation (full)"), ['exspect', 'exspectāv', 'exspectāt'], []);
		run_template2(add_word("festīnō"), get_template("1st conjugation (full)"), ['festīn', 'festīnāv', 'festīnāt'], []);
		run_template2(add_word("habitō"), get_template("1st conjugation (full)"), ['habit', 'habitāv', 'habitāt'], []);
		run_template2(add_word("incitō"), get_template("1st conjugation (full)"), ['incit', 'incitāv', 'incitāt'], []);
		run_template2(add_word("interpellō"), get_template("1st conjugation (full)"), ['interpell', 'interpellāv', 'interpellāt'], []);
		run_template2(add_word("intrō"), get_template("1st conjugation (full)"), ['intr', 'intrāv', 'intrāt'], []);
		run_template2(add_word("labōrō"), get_template("1st conjugation (full)"), ['labōr', 'labōrāv', 'labōrāt'], []);
		run_template2(add_word("lacrimō"), get_template("1st conjugation (full)"), ['lacrim', 'lacrimāv', 'lacrimāt'], [['passive'], ['supine-2'], ['gerundive']]);
		run_template2(add_word("lātrō"), get_template("1st conjugation (full)"), ['lātr', 'lātrāv', 'lātrāt'], []);
		run_template2(add_word("laudō"), get_template("1st conjugation (full)"), ['laud', 'laudāv', 'laudāt'], []);
		run_template2(add_word("lavō"), get_template("1st conjugation (full)"), ['lav', 'lāv', 'laut'], []);
		run_template2(add_word("mōnstrō"), get_template("1st conjugation (full)"), ['mōnstr', 'mōnstrāv', 'mōnstrāt'], []);
		run_template2(add_word("mussō"), get_template("1st conjugation (full)"), ['muss', 'mussāv', 'mussāt'], [['passive'], ['supine-2'], ['gerundive']]);
		run_template2(add_word("nārrō"), get_template("1st conjugation (full)"), ['nārr', 'nārrāv', 'nārrāt'], []);
		run_template2(add_word("nāvigō"), get_template("1st conjugation (full)"), ['nāvig', 'nāvigāv', 'nāvigāt'], []);
		run_template2(add_word("necō"), get_template("1st conjugation (full)"), ['nec', 'necāv', 'necāt'], []);
		run_template2(add_word("observō"), get_template("1st conjugation (full)"), ['observ', 'observāv', 'observāt'], []);
		run_template2(add_word("parō"), get_template("1st conjugation (full)"), ['par', 'parāv', 'parāt'], []);
		run_template2(add_word("pernoctō"), get_template("1st conjugation (full)"), ['pernoct', 'pernoctāv', 'pernoctāt'], [['passive'], ['supine-2'], ['gerundive']]);
		run_template2(add_word("portō"), get_template("1st conjugation (full)"), ['port', 'portāv', 'portāt'], []);
		run_template2(add_word("praecipitō"), get_template("1st conjugation (full)"), ['praecipit', 'praecipitāv', 'praecipitāt'], []);
		run_template2(add_word("pugnō"), get_template("1st conjugation (full)"), ['pugn', 'pugnāv', 'pugnāt'], []);
		run_template2(add_word("purgō"), get_template("1st conjugation (full)"), ['purg', 'purgāv', 'purgāt'], []);
		run_template2(add_word("recuperō"), get_template("1st conjugation (full)"), ['recuper', 'recuperāv', 'recuperāt'], []);
		run_template2(add_word("revocō"), get_template("1st conjugation (full)"), ['revoc', 'revocāv', 'revocāt'], []);
		run_template2(add_word("rogō"), get_template("1st conjugation (full)"), ['rog', 'rogāv', 'rogāt'], []);
		run_template2(add_word("saltō"), get_template("1st conjugation (full)"), ['salt', 'saltāv', 'saltāt'], []);
		run_template2(add_word("salūtō"), get_template("1st conjugation (full)"), ['salūt', 'salūtāv', 'salūtāt'], []);
		run_template2(add_word("servō"), get_template("1st conjugation (full)"), ['serv', 'servāv', 'servāt'], []);
		run_template2(add_word("simulō"), get_template("1st conjugation (full)"), ['simul', 'simulāv', 'simulāt'], []);
		run_template2(add_word("spectō"), get_template("1st conjugation (full)"), ['spect', 'spectāv', 'spectāt'], []);
		run_template2(add_word("stō"), get_template("1st conjugation (full)"), ['st', 'stet', 'stat'], []);
		run_template2(add_word("temptō"), get_template("1st conjugation (full)"), ['tempt', 'temptāv', 'temptāt'], []);
		run_template2(add_word("verberō"), get_template("1st conjugation (full)"), ['verber', 'verberāv', 'verberāt'], []);
		run_template2(add_word("vetō"), get_template("1st conjugation (full)"), ['vet', 'vetu', 'vetit'], []);
		run_template2(add_word("vexō"), get_template("1st conjugation (full)"), ['vex', 'vexāv', 'vexāt'], []);
		run_template2(add_word("vigilō"), get_template("1st conjugation (full)"), ['vigil', 'vigilāv', 'vigilāt'], []);
		run_template2(add_word("vīsitō"), get_template("1st conjugation (full)"), ['vīsit', 'vīsitāv', 'vīsitāt'], []);
		run_template2(add_word("vītō"), get_template("1st conjugation (full)"), ['vīt', 'vītāv', 'vītāt'], []);
		run_template2(add_word("admoveō"), get_template("2nd conjugation (full)"), ['admov', 'admōv', 'admōt'], []);
		run_template2(add_word("appāreō"), get_template("2nd conjugation (full)"), ['appār', 'appāru', ''], [['passive'], ['supine-2'], ['gerundive'], ['supine-1'], ['future', 'participle'], ['future', 'infinitive']]);
		run_template2(add_word("augeō"), get_template("2nd conjugation (full)"), ['aug', 'aux', 'auct'], []);
		run_template2(add_word("caveō"), get_template("2nd conjugation (full)"), ['cav', 'cāv', 'caut'], []);
		run_template2(add_word("cēnseō"), get_template("2nd conjugation (full)"), ['cēns', 'cēnsu', 'cēns'], []);
		run_template2(add_word("dēbeō"), get_template("2nd conjugation (full)"), ['dēb', 'dēbu', 'dēbit'], []);
		run_template2(add_word("doceō"), get_template("2nd conjugation (full)"), ['doc', 'docu', 'doct'], []);
		run_template2(add_word("doleō"), get_template("2nd conjugation (full)"), ['dol', 'dolu', ''], [['passive'], ['supine-2'], ['gerundive'], ['supine-1'], ['future', 'participle'], ['future', 'infinitive']]);
		run_template2(add_word("faveō"), get_template("2nd conjugation (full)"), ['fav', 'fāv', ''], [['passive'], ['supine-2'], ['gerundive'], ['supine-1'], ['future', 'participle'], ['future', 'infinitive']]);
		run_template2(add_word("habeō"), get_template("2nd conjugation (full)"), ['hab', 'habu', 'habit'], []);
		run_template2(add_word("haereō"), get_template("2nd conjugation (full)"), ['haer', 'haes', ''], [['passive'], ['supine-2'], ['gerundive'], ['supine-1'], ['future', 'participle'], ['future', 'infinitive']]);
		run_template2(add_word("jaceō"), get_template("2nd conjugation (full)"), ['jac', 'jacu', ''], [['passive'], ['supine-2'], ['gerundive'], ['supine-1'], ['future', 'participle'], ['future', 'infinitive']]);
		run_template2(add_word("iubeō"), get_template("2nd conjugation (full)"), ['iub', 'iuss', 'iuss'], []);
		run_template2(add_word("licet"), get_template("2nd conjugation (full)"), ['lic', 'licu', ''], [['person-1'], ['person-2'], ['passive'], ['supine-2'], ['gerundive'], ['supine-1'], ['future', 'participle'], ['future', 'infinitive']]);
		run_template2(add_word("lūceō"), get_template("2nd conjugation (full)"), ['lūc', 'lūx', ''], [['passive'], ['supine-2'], ['gerundive'], ['supine-1'], ['future', 'participle'], ['future', 'infinitive']]);
		run_template2(add_word("maneō"), get_template("2nd conjugation (full)"), ['man', 'māns', 'māns'], []);
		run_template2(add_word("moveō"), get_template("2nd conjugation (full)"), ['mov', 'mōv', 'mōt'], []);
		run_template2(add_word("noceō"), get_template("2nd conjugation (full)"), ['noc', 'nocu', ''], [['passive'], ['supine-2'], ['gerundive'], ['supine-1'], ['future', 'participle'], ['future', 'infinitive']]);
		run_template2(add_word("obsideō"), get_template("2nd conjugation (full)"), ['obsid', 'obsēd', 'obsess'], []);
		run_template2(add_word("removeō"), get_template("2nd conjugation (full)"), ['remov', 'remōv', 'remōt'], []);
		run_template2(add_word("respondeō"), get_template("2nd conjugation (full)"), ['respond', 'respond', 'respōns'], []);
		run_template2(add_word("rīdeō"), get_template("2nd conjugation (full)"), ['rīd', 'rīs', 'rīs'], []);
		run_template2(add_word("sedeō"), get_template("2nd conjugation (full)"), ['sed', 'sēd', 'sess'], []);
		run_template2(add_word("stupeō"), get_template("2nd conjugation (full)"), ['stup', 'stupu', ''], [['passive'], ['supine-2'], ['gerundive'], ['supine-1'], ['future', 'participle'], ['future', 'infinitive']]);
		run_template2(add_word("taceō"), get_template("2nd conjugation (full)"), ['tac', 'tacu', 'tacit'], []);
		run_template2(add_word("teneō"), get_template("2nd conjugation (full)"), ['ten', 'tenu', 'tent'], []);
		run_template2(add_word("terreō"), get_template("2nd conjugation (full)"), ['terr', 'terru', 'territ'], []);
		run_template2(add_word("timeō"), get_template("2nd conjugation (full)"), ['tim', 'timu', ''], [['passive'], ['supine-2'], ['gerundive'], ['supine-1'], ['future', 'participle'], ['future', 'infinitive']]);
		run_template2(add_word("videō"), get_template("2nd conjugation (full)"), ['vid', 'vīd', 'vīs'], []);
		run_template2(add_word("accidō"), get_template("3rd conjugation (full)"), ['accid', 'accid', ''], [['passive'], ['supine-2'], ['gerundive'], ['supine-1'], ['future', 'participle'], ['future', 'infinitive']]);
		run_template2(add_word("advesperāscit"), get_template("3rd conjugation (full)"), ['advesperāsc', 'advesperāv', ''], [['person-1'], ['person-2'], ['passive'], ['supine-2'], ['gerundive'], ['supine-1'], ['future', 'participle'], ['future', 'infinitive']]);
		run_template2(add_word("agnōscō"), get_template("3rd conjugation (full)"), ['agnōsc', 'agnōv', 'agnit'], []);
		run_template2(add_word("agō"), get_template("3rd conjugation (full)"), ['ag', 'ēg', 'āct'], []);
		run_template2(add_word("alō"), get_template("3rd conjugation (full)"), ['al', 'alu', 'alit'], []);
		run_template2(add_word("ascendō"), get_template("3rd conjugation (full)"), ['ascend', 'ascend', 'ascēns'], [['passive'], ['supine-2'], ['gerundive']]);
		run_template2(add_word("cadō"), get_template("3rd conjugation (full)"), ['cad', 'cecid', 'cās'], [['passive'], ['supine-2'], ['gerundive']]);
		run_template2(add_word("claudō"), get_template("3rd conjugation (full)"), ['claud', 'claus', 'claus'], []);
		run_template2(add_word("colō"), get_template("3rd conjugation (full)"), ['col', 'colu', 'cult'], []);
		run_template2(add_word("concidō"), get_template("3rd conjugation (full)"), ['concid', 'concid', ''], [['passive'], ['supine-2'], ['gerundive'], ['supine-1'], ['future', 'participle'], ['future', 'infinitive']]);
		run_template2(add_word("condō"), get_template("3rd conjugation (full)"), ['cond', 'condid', 'condit'], []);
		run_template2(add_word("condūcō"), get_template("3rd conjugation (full)"), ['condūc', 'condūx', 'conduct'], []);
		run_template2(add_word("cōnsidō"), get_template("3rd conjugation (full)"), ['cōnsid', 'cōnsēd', 'cōnsess'], [['passive'], ['supine-2'], ['gerundive']]);
		run_template2(add_word("cōnstituō"), get_template("3rd conjugation (full)"), ['cōnstitu', 'cōnstitu', 'cōnstitūt'], []);
		run_template2(add_word("cōnsulō"), get_template("3rd conjugation (full)"), ['cōnsul', 'cōnsulu', 'cōnsult'], []);
		run_template2(add_word("coquō"), get_template("3rd conjugation (full)"), ['coqu', 'cox', 'coct'], []);
		run_template2(add_word("currō"), get_template("3rd conjugation (full)"), ['curr', 'cucurr', 'curs'], []);
		run_template2(add_word("dēfendō"), get_template("3rd conjugation (full)"), ['dēfend', 'dēfend', 'dēfēns'], []);
		run_template2(add_word("dēscendō"), get_template("3rd conjugation (full)"), ['dēscend', 'dēscend', 'dēscēns'], []);
		run_template2(add_word("dēvertō"), get_template("3rd conjugation (full)"), ['dēvert', 'dēvert', 'dēvers'], []);
		run_template2(add_word("dīcō"), get_template("3rd conjugation (full)"), ['dīc', 'dīx', 'dict'], []);
		run_template2(add_word("discēdō"), get_template("3rd conjugation (full)"), ['discēd', 'discess', 'discess'], []);
		run_template2(add_word("dūcō"), get_template("3rd conjugation (full)"), ['dūc', 'dūx', 'duct'], []);
		run_template2(add_word("emō"), get_template("3rd conjugation (full)"), ['em', 'ēm', 'empt'], []);
		run_template2(add_word("extendō"), get_template("3rd conjugation (full)"), ['extend', 'extend', 'extent'], []);
		run_template2(add_word("extrahō"), get_template("3rd conjugation (full)"), ['extrah', 'extrāx', 'extract'], []);
		run_template2(add_word("gemō"), get_template("3rd conjugation (full)"), ['gem', 'gemu', 'gemit'], []);
		run_template2(add_word("gerō"), get_template("3rd conjugation (full)"), ['ger', 'gess', 'gest'], []);
		run_template2(add_word("induō"), get_template("3rd conjugation (full)"), ['indu', 'indu', 'indūt'], []);
		run_template2(add_word("inūrō"), get_template("3rd conjugation (full)"), ['inūr', 'inuss', 'inust'], []);
		run_template2(add_word("lambō"), get_template("3rd conjugation (full)"), ['lamb', 'lamb', 'lambit'], []);
		run_template2(add_word("legō"), get_template("3rd conjugation (full)"), ['leg', 'lēg', 'lēct'], []);
		run_template2(add_word("lūdō"), get_template("3rd conjugation (full)"), ['lūd', 'lūs', 'lūs'], []);
		run_template2(add_word("mittō"), get_template("3rd conjugation (full)"), ['mitt', 'mīs', 'miss'], []);
		run_template2(add_word("occurrō"), get_template("3rd conjugation (full)"), ['occur', 'occurr', 'occurs'], []);
		run_template2(add_word("petō"), get_template("3rd conjugation (full)"), ['pet', 'petīv', 'petīt'], []);
		run_template2(add_word("pluit"), get_template("3rd conjugation (full)"), ['plu', 'pluit , plūv', ''], [['person-1'], ['person-2'], ['passive'], ['supine-2'], ['gerundive'], ['supine-1'], ['future', 'participle'], ['future', 'infinitive']]);
		run_template2(add_word("pōnō"), get_template("3rd conjugation (full)"), ['pōn', 'posu', 'posit'], []);
		run_template2(add_word("praecurrō"), get_template("3rd conjugation (full)"), ['praecurr', 'praecucurrī,praecurr', 'praecurs'], []);
		run_template2(add_word("prōmittō"), get_template("3rd conjugation (full)"), ['prōmitt', 'prōmīs', 'prōmiss'], []);
		run_template2(add_word("quiēscō"), get_template("3rd conjugation (full)"), ['quiēsc', 'quiēv', 'quiēt'], []);
		run_template2(add_word("regō"), get_template("3rd conjugation (full)"), ['reg', 'rēx', 'rēct'], []);
		run_template2(add_word("relinquō"), get_template("3rd conjugation (full)"), ['relinqu', 'relīqu', 'relict'], []);
		run_template2(add_word("repellō"), get_template("3rd conjugation (full)"), ['repell', 'reppul', 'repuls'], []);
		run_template2(add_word("reprehendō"), get_template("3rd conjugation (full)"), ['reprehend', 'reprehend', 'reprehēns'], []);
		run_template2(add_word("scrībō"), get_template("3rd conjugation (full)"), ['scrīb', 'scrīps', 'scrīpt'], []);
		run_template2(add_word("stertō"), get_template("3rd conjugation (full)"), ['stert', 'stertu', ''], [['passive'], ['supine-2'], ['gerundive'], ['supine-1'], ['future', 'participle'], ['future', 'infinitive']]);
		run_template2(add_word("stringō"), get_template("3rd conjugation (full)"), ['string', 'strīnx', 'strict'], []);
		run_template2(add_word("sūmō"), get_template("3rd conjugation (full)"), ['sūm', 'sūmps', 'sūmpt'], []);
		run_template2(add_word("surgō"), get_template("3rd conjugation (full)"), ['surg', 'surrēx', 'surrēct'], []);
		run_template2(add_word("trādō"), get_template("3rd conjugation (full)"), ['trād', 'trādid', 'trādit'], []);
		run_template2(add_word("trahō"), get_template("3rd conjugation (full)"), ['trah', 'trāx', 'tract'], []);
		run_template2(add_word("tremō"), get_template("3rd conjugation (full)"), ['trem', 'tremu', ''], [['passive'], ['supine-2'], ['gerundive'], ['supine-1'], ['future', 'participle'], ['future', 'infinitive']]);
		run_template2(add_word("vertō"), get_template("3rd conjugation (full)"), ['vert', 'vert', 'vers'], []);
		run_template2(add_word("vincō"), get_template("3rd conjugation (full)"), ['vinc', 'vīc', 'vict'], []);
		run_template2(add_word("arripiō"), get_template("3rd conjugation -io (full)"), ['arrip', 'arripu', 'arrept'], []);
		run_template2(add_word("capiō"), get_template("3rd conjugation -io (full)"), ['cap', 'cēp', 'capt'], []);
		run_template2(add_word("cōnficiō"), get_template("3rd conjugation -io (full)"), ['cōnfic', 'cōnfēc', 'cōnfect'], []);
		run_template2(add_word("coniciō"), get_template("3rd conjugation -io (full)"), ['conic', 'coniēc', 'coniect'], []);
		run_template2(add_word("cōnspiciō"), get_template("3rd conjugation -io (full)"), ['cōnspic', 'cōnspex', 'cōnspect'], []);
		run_template2(add_word("effugiō"), get_template("3rd conjugation -io (full)"), ['effug', 'effūg', 'effugit'], []);
		run_template2(add_word("excipiō"), get_template("3rd conjugation -io (full)"), ['excip', 'excēp', 'except'], []);
		run_template2(add_word("faciō"), get_template("3rd conjugation -io (full)"), ['fac', 'fēc', 'fact'], []);
		run_template2(add_word("fugiō"), get_template("3rd conjugation -io (full)"), ['fug', 'fūg', 'fugit'], []);
		run_template2(add_word("jaciō"), get_template("3rd conjugation -io (full)"), ['jac', 'iēc', 'jact'], []);
		run_template2(add_word("īnspiciō"), get_template("3rd conjugation -io (full)"), ['īnspic', 'īnspex', 'īnspect'], []);
		run_template2(add_word("olfaciō"), get_template("3rd conjugation -io (full)"), ['olfac', 'olfēc', 'olfact'], []);
		run_template2(add_word("perficiō"), get_template("3rd conjugation -io (full)"), ['perfic', 'perfēc', 'perfect'], []);
		run_template2(add_word("adveniō"), get_template("4th conjugation (full)"), ['adven', 'advēn', 'advent'], []);
		run_template2(add_word("aperiō"), get_template("4th conjugation (full)"), ['aper', 'aperu', 'apert'], []);
		run_template2(add_word("audiō"), get_template("4th conjugation (full)"), ['aud', 'audīv', 'audīt'], []);
		run_template2(add_word("custōdiō"), get_template("4th conjugation (full)"), ['custōd', 'custōdīv', 'custōdīt'], []);
		run_template2(add_word("dormiō"), get_template("4th conjugation (full)"), ['dorm', 'dormīv', 'dormīt'], []);
		run_template2(add_word("ēsuriō"), get_template("4th conjugation (full)"), ['ēsur', 'ēsurīv', ''], [['passive'], ['supine-2'], ['gerundive'], ['supine-1'], ['future', 'participle'], ['future', 'infinitive']]);
		run_template2(add_word("feriō"), get_template("4th conjugation (full)"), ['fer', 'ferīv', 'ferīt'], []);
		run_template2(add_word("fīniō"), get_template("4th conjugation (full)"), ['fīn', 'fīnīv', 'fīnīt'], []);
		run_template2(add_word("impediō"), get_template("4th conjugation (full)"), ['imped', 'impedīv', 'impedīt'], []);
		run_template2(add_word("inveniō"), get_template("4th conjugation (full)"), ['inven', 'invēn', 'invent'], []);
		run_template2(add_word("nesciō"), get_template("4th conjugation (full)"), ['nesc', 'nescīv', 'nescīt'], []);
		run_template2(add_word("obdormiō"), get_template("4th conjugation (full)"), ['obdorm', 'obdormīv', 'obdormīt'], []);
		run_template2(add_word("pūniō"), get_template("4th conjugation (full)"), ['pūn', 'pūnīv', 'pūnīt'], []);
		run_template2(add_word("sciō"), get_template("4th conjugation (full)"), ['sc', 'scīv', 'scīt'], []);
		run_template2(add_word("veniō"), get_template("4th conjugation (full)"), ['ven', 'vēn', 'vent'], [['person-1', 'passive'], ['person-2', 'passive']]);
?></body></head>
