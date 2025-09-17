<?php
class Question {
  public \$statement;
  public \$options;
  public \$answer;

  public function __construct(\$statement, \$options, \$answer) {
    \$this->statement = \$statement;
    \$this->options = \$options;
    \$this->answer = \$answer;
  }

  public static function all() {
    \$file = __DIR__ . '/../data/questions.json';
    if (!file_exists(\$file)) return [];
    \$json = file_get_contents(\$file);
    \$arr = json_decode(\$json, true);
  return \$arr ?: [];
  }
}
?>