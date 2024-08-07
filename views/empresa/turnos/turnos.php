<h1><?php echo $titulo; ?></h1>

    <form method="post" action="/empresa/turnos/turnos">
        <label for="servicio">Selecciona un Servicio:</label>
        <select id="servicio" name="idServicio" required>
            <option value="">Seleccione un servicio</option>
            <?php foreach ($servicios as $servicio): ?>
                <option value="<?php echo htmlspecialchars($servicio->id, ENT_QUOTES, 'UTF-8'); ?>">
                    <?php echo htmlspecialchars($servicio->nombreServicio, ENT_QUOTES, 'UTF-8'); ?>
                </option>
            <?php endforeach; ?>
        </select>
        <button type="submit">Ver Turnos</button>
    </form>

    <?php if (!empty($turnos)): ?>
        <?php
            // Obtener los días y las horas únicas de los turnos
            $diasUnicos = [];
            $horasUnicas = [];

            foreach ($turnos as $turno) {
                $dias = explode(',', $turno->dias);
                foreach ($dias as $dia) {
                    if (!in_array($dia, $diasUnicos)) {
                        $diasUnicos[] = $dia;
                    }
                }
                if (!in_array($turno->horaInicio, $horasUnicas)) {
                    $horasUnicas[] = $turno->horaInicio;
                }
            }

            sort($diasUnicos); // Ordenar los días alfabéticamente
            sort($horasUnicas); // Ordenar las horas cronológicamente
        ?>

        <h2>Turnos del Servicio Seleccionado</h2>
        <table>
            <thead>
                <tr>
                    <th>Día / Hora</th>
                    <?php foreach ($horasUnicas as $hora): ?>
                        <th><?php echo $hora; ?></th>
                    <?php endforeach; ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($diasUnicos as $dia): ?>
                    <tr>
                        <td><?php echo $dia; ?></td>
                        <?php foreach ($horasUnicas as $hora): ?>
                            <td>
                                <?php
                                // Verificar si existe un turno para este día y hora
                                $hayTurno = false;
                                foreach ($turnos as $turno) {
                                    if (strpos($turno->dias, $dia) !== false && $turno->horaInicio === $hora) {
                                        $hayTurno = true;
                                        break;
                                    }
                                }
                                echo $hayTurno ? 'Reservo X' : 'no existe'; // Marca con una "X" si hay un turno
                                ?>
                            </td>
                        <?php endforeach; ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>