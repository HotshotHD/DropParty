<?php

namespace dropparty\task;

use pocketmine\scheduler\PluginTask;
use dropparty\DropParty;
use pocketmine\item\Item;
use pocketmine\utils\Config;
use pocketmine\math\Vector3;

class DropPartyTask extends PluginTask {
	
	public function __construct(DropParty $plugin) {
	  parent::__construct($plugin);
	  $this->plugin = $plugin;
	}
	
	public function getPlugin() {
	  return $this->plugin;
	}
	
	public function onRun($currentTick) {
	  $this->getPlugin()->time = $this->getPlugin()->time - 1;
		
	  if($this->getPlugin()->time > 0) {
	    $this->getPlugin()->getServer()->broadcastMessage("§7[§dDropParty§7] §aStarting in §7" . $this->getPlugin()->time . " §amins.");
	   }
	  if($this->getPlugin()->time == 0) {
	    $this->getPlugin()->getServer()->broadcastMessage("§7[§dDropParty§7]§a Has started!");
	    $this->getPlugin()->status = "enabled";
			
	   }
			
			
	}
		
}
