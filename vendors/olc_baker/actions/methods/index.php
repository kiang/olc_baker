
    function <{$actionName}>() {
        $this->paginate['<{$modelName}>'] = array(
            'limit' => 20,
        );
        $this->set('items', $this->paginate($this-><{$modelName}>));
    }
