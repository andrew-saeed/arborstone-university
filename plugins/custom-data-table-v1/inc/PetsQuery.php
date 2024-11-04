<?

class PetsQuery {
    public $pets;
    public $count;

    private $args;
    private $placeholders;

    function __construct() {
        global $wpdb;

        $tablename = $wpdb->prefix . 'pets';
        $this->args = $this->getArgs();
        $this->placeholders = $this->getPlaceholders();

        $query = "SELECT * FROM $tablename ";
        $query .= $this->getWheres();
        $query .= ' ORDER BY birthyear DESC';
        var_dump($query);
        $this->count = $wpdb->get_var($wpdb->prepare("SELECT COUNT(*) FROM $tablename", []));
        $this->pets = $wpdb->get_results($wpdb->prepare($query, $this->placeholders));
    }

    function getArgs() {

        $temp = [];

        if(isset($_GET['beforeYear'])) $temp['beforeYear'] = sanitize_text_field($_GET['beforeYear']);
        if(isset($_GET['afterYear'])) $temp['afterYear'] = sanitize_text_field($_GET['afterYear']);
        if(isset($_GET['minWeight'])) $temp['minWeight'] = sanitize_text_field($_GET['minWeight']);
        if(isset($_GET['maxWeight'])) $temp['maxWeight'] = sanitize_text_field($_GET['maxWeight']);

        return array_filter($temp, fn($x) => $x);
    }

    function getPlaceholders() {
        return array_map(fn($k) => $k, $this->args);
    }

    function getWheres() {
        $whereQuery = '';

        if(count($this->args)) $whereQuery = 'WHERE ';

        $currentPosition = 0;
        foreach($this->args as $index => $item) {
            $whereQuery .= $this->getPartialQ($index);

            if($currentPosition != count($this->args) - 1) $whereQuery .= " AND ";

            $currentPosition++;
        }

        return $whereQuery;
    }

    function getPartialQ($index) {
        return match($index) {
            'beforeYear' => 'birthyear <= %d',
            'afterYear' => 'birthyear >= %d',
            'minWeight' => 'petweight >= %d',
            'maxWeight' => 'petweight <= %d',
            default => $index . ' = %s'
        };
    }
}