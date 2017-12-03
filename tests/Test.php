<?php
declare(strict_types=1);

namespace AdventOfCode2017Tests;

use AdventOfCode2017\Day01;
use AdventOfCode2017\Day02;
use PHPUnit\Framework\TestCase;

class Test extends TestCase {

	function day01Part1Examples() {
		return [
			['1122', 3],
			['1111', 4],
			['1234', 0],
			['91212129', 9],
			['5672987533353956199629683941564528646262567117433461547747793928322958646779832484689174151918261551689221756165598898428736782194511627829355718493723961323272136452517987471351381881946883528248611611258656199812998632682668749683588515362946994415852337196718476219162124978836537348924591957188827929753417884942133844664636969742547717228255739959316351852731598292529837885992781815131876183578461135791315287135243541659853734343376618419952776165544829717676988897684141328138348382882699672957866146524759879236555935723655326743713542931693477824289283542468639522271643257212833248165391957686226311246517978319253977276663825479144321155712866946255992634876158822855382331452649953283788863248192338245943966269197421474555779135168637263279579842885347152287275679811576594376535226167894981226866222987522415785244875882556414956724976341627123557214837873872723618395529735349273241686548287549763993653379539445435319698825465289817663294436458194867278623978745981799283789237555242728291337538498616929817268211698649236646127899982839523784837752863458819965485149812959121884771849954723259365778151788719941888128618552455879369919511319735525621198185634342538848462461833332917986297445388515717463168515123732455576143447454835849565757773325367469763383757677938748319968971312267871619951657267913817242485559771582167295794259441256284168356292785568858527184122231262465193612127961685513913835274823892596923786613299747347259254823531262185328274367529265868856512185135329652635938373266759964119863494798222245536758792389789818646655287856173534479551364115976811459677123592747375296313667253413698823655218254168196162883437389718167743871216373164865426458794239496224858971694877159591215772938396827435289734165853975267521291574436567193473814247981877735223376964125359992555885137816647382139596646856417424617847981855532914872251686719394341764324395254556782277426326331441981737557262581762412544849689472281645835957667217384334435391572985228286537574388834835693416821419655967456137395465649249256572866516984318344482684936625486311718525523265165', 1136]
		];
	}

	/**
	 * @dataProvider day01Part1Examples
	 */
	function testDay01Part1($input, $output) {
		$day = new Day01();
		$this->assertEquals($output, $day->solvePart1($input));
	}

	function day01Part2Examples() {
		return [
			['1212', 6],
			['1221', 0],
			['123425', 4],
			['123123', 12],
			['12131415', 4],
			['5672987533353956199629683941564528646262567117433461547747793928322958646779832484689174151918261551689221756165598898428736782194511627829355718493723961323272136452517987471351381881946883528248611611258656199812998632682668749683588515362946994415852337196718476219162124978836537348924591957188827929753417884942133844664636969742547717228255739959316351852731598292529837885992781815131876183578461135791315287135243541659853734343376618419952776165544829717676988897684141328138348382882699672957866146524759879236555935723655326743713542931693477824289283542468639522271643257212833248165391957686226311246517978319253977276663825479144321155712866946255992634876158822855382331452649953283788863248192338245943966269197421474555779135168637263279579842885347152287275679811576594376535226167894981226866222987522415785244875882556414956724976341627123557214837873872723618395529735349273241686548287549763993653379539445435319698825465289817663294436458194867278623978745981799283789237555242728291337538498616929817268211698649236646127899982839523784837752863458819965485149812959121884771849954723259365778151788719941888128618552455879369919511319735525621198185634342538848462461833332917986297445388515717463168515123732455576143447454835849565757773325367469763383757677938748319968971312267871619951657267913817242485559771582167295794259441256284168356292785568858527184122231262465193612127961685513913835274823892596923786613299747347259254823531262185328274367529265868856512185135329652635938373266759964119863494798222245536758792389789818646655287856173534479551364115976811459677123592747375296313667253413698823655218254168196162883437389718167743871216373164865426458794239496224858971694877159591215772938396827435289734165853975267521291574436567193473814247981877735223376964125359992555885137816647382139596646856417424617847981855532914872251686719394341764324395254556782277426326331441981737557262581762412544849689472281645835957667217384334435391572985228286537574388834835693416821419655967456137395465649249256572866516984318344482684936625486311718525523265165', 1092]
		];
	}

	/**
	 * @dataProvider day01Part2Examples
	 */
	function testDay01Part2($input, $output) {
		$day = new Day01();
		$this->assertEquals($output, $day->solvePart2($input));
	}

	function day02Part1Examples() {
		return [
			["5\t1\t9\t5\n7\t5\t3\n2\t4\t6\t8", 18],
			["179\t2358\t5197\t867\t163\t4418\t3135\t5049\t187\t166\t4682\t5080\t5541\t172\t4294\t1397\n2637\t136\t3222\t591\t2593\t1982\t4506\t195\t4396\t3741\t2373\t157\t4533\t3864\t4159\t142\n1049\t1163\t1128\t193\t1008\t142\t169\t168\t165\t310\t1054\t104\t1100\t761\t406\t173\n200\t53\t222\t227\t218\t51\t188\t45\t98\t194\t189\t42\t50\t105\t46\t176\n299\t2521\t216\t2080\t2068\t2681\t2376\t220\t1339\t244\t605\t1598\t2161\t822\t387\t268\n1043\t1409\t637\t1560\t970\t69\t832\t87\t78\t1391\t1558\t75\t1643\t655\t1398\t1193\n90\t649\t858\t2496\t1555\t2618\t2302\t119\t2675\t131\t1816\t2356\t2480\t603\t65\t128\n2461\t5099\t168\t4468\t5371\t2076\t223\t1178\t194\t5639\t890\t5575\t1258\t5591\t6125\t226\n204\t205\t2797\t2452\t2568\t2777\t1542\t1586\t241\t836\t3202\t2495\t197\t2960\t240\t2880\n560\t96\t336\t627\t546\t241\t191\t94\t368\t528\t298\t78\t76\t123\t240\t563\n818\t973\t1422\t244\t1263\t200\t1220\t208\t1143\t627\t609\t274\t130\t961\t685\t1318\n1680\t1174\t1803\t169\t450\t134\t3799\t161\t2101\t3675\t133\t4117\t3574\t4328\t3630\t4186\n1870\t3494\t837\t115\t1864\t3626\t24\t116\t2548\t1225\t3545\t676\t128\t1869\t3161\t109\n890\t53\t778\t68\t65\t784\t261\t682\t563\t781\t360\t382\t790\t313\t785\t71\n125\t454\t110\t103\t615\t141\t562\t199\t340\t80\t500\t473\t221\t573\t108\t536\n1311\t64\t77\t1328\t1344\t1248\t1522\t51\t978\t1535\t1142\t390\t81\t409\t68\t352", 39126],
		];
	}

	/**
	 * @dataProvider day02Part1Examples
	 */
	function testDay02Part1($input, $output) {
		$day = new Day02();
		$this->assertEquals($output, $day->solvePart1($input));
	}

	function day02Part2Examples() {
		return [
			["5\t9\t2\t8\n9\t4\t7\t3\n3\t8\t6\t5", 9],
			["179\t2358\t5197\t867\t163\t4418\t3135\t5049\t187\t166\t4682\t5080\t5541\t172\t4294\t1397\n2637\t136\t3222\t591\t2593\t1982\t4506\t195\t4396\t3741\t2373\t157\t4533\t3864\t4159\t142\n1049\t1163\t1128\t193\t1008\t142\t169\t168\t165\t310\t1054\t104\t1100\t761\t406\t173\n200\t53\t222\t227\t218\t51\t188\t45\t98\t194\t189\t42\t50\t105\t46\t176\n299\t2521\t216\t2080\t2068\t2681\t2376\t220\t1339\t244\t605\t1598\t2161\t822\t387\t268\n1043\t1409\t637\t1560\t970\t69\t832\t87\t78\t1391\t1558\t75\t1643\t655\t1398\t1193\n90\t649\t858\t2496\t1555\t2618\t2302\t119\t2675\t131\t1816\t2356\t2480\t603\t65\t128\n2461\t5099\t168\t4468\t5371\t2076\t223\t1178\t194\t5639\t890\t5575\t1258\t5591\t6125\t226\n204\t205\t2797\t2452\t2568\t2777\t1542\t1586\t241\t836\t3202\t2495\t197\t2960\t240\t2880\n560\t96\t336\t627\t546\t241\t191\t94\t368\t528\t298\t78\t76\t123\t240\t563\n818\t973\t1422\t244\t1263\t200\t1220\t208\t1143\t627\t609\t274\t130\t961\t685\t1318\n1680\t1174\t1803\t169\t450\t134\t3799\t161\t2101\t3675\t133\t4117\t3574\t4328\t3630\t4186\n1870\t3494\t837\t115\t1864\t3626\t24\t116\t2548\t1225\t3545\t676\t128\t1869\t3161\t109\n890\t53\t778\t68\t65\t784\t261\t682\t563\t781\t360\t382\t790\t313\t785\t71\n125\t454\t110\t103\t615\t141\t562\t199\t340\t80\t500\t473\t221\t573\t108\t536\n1311\t64\t77\t1328\t1344\t1248\t1522\t51\t978\t1535\t1142\t390\t81\t409\t68\t352", 1092],
		];
	}

	/**
	 * @dataProvider day02Part2Examples
	 */
	function testDay02Part2($input, $output) {
		$day = new Day02();
		$this->assertEquals($output, $day->solvePart2($input));
	}

}