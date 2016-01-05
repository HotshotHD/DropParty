<?php

namespace dropparty;

use pocketmine\plugin\PluginBase;
use dropparty\task\DropItemsTask;
use dropparty\task\DropPartyTask;
use pocketmine\utils\Config;

class DropParty extends PluginBase {
	
	public $secs = 0;
	public $tasks = [];
	public $status;
	public $time;
	
	public function onEnable() {
		$this->getLogger()->info("Has been enabled");
		@mkdir($this->getDataFolder());
		@mkdir($this->getDataFolder() . "config/");
		$this->cfg = (new Config($this->getDataFolder() . "config/" . "config.yml", Config::YAML, array(
		"World" => "world",
		"Time" => 10,
		"Coordinates" => [
		"X" => 0,
		"Y" => 0,
		"Z" => 0,
		],
		"Items" => [
		57,
		42,
		22,
		41,
		],
		)))->getAll();
		
		$this->time = $this->cfg["Time"];
		$this->getServer()->getScheduler()->scheduleRepeatingTask(new task\DropPartyTask($this), 20 * 60);
		$this->getServer()->getScheduler()->scheduleRepeatingTask(new task\DropItemsTask($this), 20);
	}
	
	public function getDropPartyTask() {
		return new DropPartyTask($this);
	}
	
	public function getDropItemsTask() {
		return new DropItemsTask($this);
	}
	
	public function getRandomItem() {
	  $rand = mt_rand(0, count($this->cfg["Items"]) - 1);
		
	  return $this->cfg["Items"][$rand];
		
	}
	
}
