<?php
$get_data_kriteria = $this->db->query("SELECT * FROM `electre_criterias`")->result();
$get_data_alt = $this->db->query("SELECT * FROM `electre_alternatives`")->result();
?>
<table class='table' border='1'>
    <thead>
        <tr>
            <th rowspan='2'>Alternatif</th>
            <th colspan='<?= count($get_data_kriteria); ?>'>Criteria</th>
        </tr>
        <tr>
            <?php
            foreach ($get_data_kriteria as $key => $value) {
                echo'<th>C.'.$value->id_criteria.'</th>';
            }
            ?>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($get_data_alt as $key => $value) {
            echo'
            <tr>
                <td>'.$value->id_alternative.'</td>';
                foreach ($get_data_kriteria as $key => $row) {
                    $get_select_eval = $this->db->query("SELECT * FROM electre_evaluations a WHERE a.id_alternative='".$value->id_alternative."' AND a.id_criteria='".$row->id_criteria."' LIMIT 1")->row_array();
                    echo'<td>'.$get_select_eval['value'].'</td>';
                }
            echo'</tr>';
        }
        ?>
    </tbody>
</table>