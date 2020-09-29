<?php declare(strict_types=1);
namespace Tranquillity\Action;

// Application classes
use Tranquillity\Responder\Responder;

abstract class AbstractAction {

    /**
     * @var Responder
     */
    protected $responder;

    public function __construct(Responder $responder) {
        $this->responder = $responder;
    }
}