<?php

use Goteo\Library\Text;

$bodyClass = 'admin';

/*
 * TODO
 *
    <a href="/admin/accounting/details/<?php echo $invest->id; ?>">[Detalles]</a>
    <a href="/admin/accounting/execute/<?php echo $invest->id; ?>">[Ejecutar]</a>
 */

$filters = $this['filters'];

include 'view/prologue.html.php';

    include 'view/header.html.php'; ?>

        <div id="sub-header">
            <div>
                <h2>Listado de aportes</h2>
            </div>

            <div class="sub-menu">
                <div class="admin-menu">
                    <ul>
                        <li class="home"><a href="/admin">Mainboard</a></li>
                        <li class="checking"><a href="/admin/checking">Revisión de proyectos</a></li>
                        <li class="accounting"><a href="/admin/accounting/invest">Generar aportes manualmente</a></li>
                        <li><a href="/cron" target="_blank">Ejecutar proceso cron</a></li>
                    </ul>
                </div>
            </div>

        </div>

        <div id="main">
            <?php if (!empty($this['errors']) || !empty($this['success'])) : ?>
                <div class="widget">
                    <p>
                        <?php echo implode(',', $this['errors']); ?>
                        <?php echo implode(',', $this['success']); ?>
                    </p>
                </div>
            <?php endif; ?>

            <!-- filtros -->
            <?php $the_filters = array(
                'projects' => array (
                    'label' => 'Proyecto:',
                    'first' => 'Todos los proyectos'),
                'users' => array (
                    'label' => 'Usuario:',
                    'first' => 'Todos los usuarios'),
                'methods' => array (
                    'label' => 'Tipo de aporte',
                    'first' => 'Todos los tipos'),
                'status' => array (
                    'label' => 'Estado de proyecto:',
                    'first' => 'Todos los estados'),
                'investStatus' => array (
                    'label' => 'Estado de aporte:',
                    'first' => 'Todos los estados'),
                'campaigns' => array (
                    'label' => 'Campaña:',
                    'first' => 'Todas las campañas'),
            ); ?>
            <div class="widget board">
                <h3 class="title">Filtros</h3>
                <form id="filter-form" action="/admin/accounting" method="get">
                    <?php foreach ($the_filters as $filter=>$data) : ?>
                    <div style="float:left;margin:5px;">
                        <label for="<?php echo $filter ?>-filter"><?php echo $data['label'] ?></label><br />
                        <select id="<?php echo $filter ?>-filter" name="<?php echo $filter ?>" onchange="document.getElementById('filter-form').submit();">
                            <option value=""><?php echo $data['first'] ?></option>
                        <?php foreach ($this[$filter] as $itemId=>$itemName) : ?>
                            <option value="<?php echo $itemId; ?>"<?php if ($filters[$filter] == $itemId) echo ' selected="selected"';?>><?php echo $itemName; ?></option>
                        <?php endforeach; ?>
                        </select>
                    </div>
                    <?php endforeach; ?>
                </form>
            </div>

            <div class="widget board">
            <?php if (!empty($this['list'])) : ?>
                <table width="100%">
                    <thead>
                        <tr>
                            <th>Aporte ID</th>
                            <th>Cofinanciador</th>
                            <th>Proyecto</th>
                            <th>Estado</th>
                            <th>Metodo</th>
                            <th>Estado aporte</th>
                            <th>Importe</th>
                            <th>Campaña</th>
                            <th>Aportado</th>
                            <th>Cargado</th>
                            <th>Devuelto</th>
                            <th>Anónimo</th>
                            <th>Donativo</th>
                            <th>Manual</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($this['list'] as $invest) : ?>
                        <tr>
                            <td><?php echo $invest->id ?></td>
                            <td><?php echo $this['users'][$invest->user] ?></td>
                            <td><?php echo $this['projects'][$invest->project] ?></td>
                            <td><?php echo $this['status'][$invest->status] ?></td>
                            <td><?php echo $this['methods'][$invest->method] ?></td>
                            <td><?php echo $this['investStatus'][$invest->investStatus] ?></td>
                            <td><?php echo $invest->amount ?></td>
                            <td><?php echo $this['campaigns'][$invest->campaign] ?></td>
                            <td><?php echo $invest->invested ?></td>
                            <td><?php echo $invest->charged ?></td>
                            <td><?php echo $invest->returned ?></td>
                            <td><?php if ($invest->anonymous == 1)  echo 'Anónimo' ?></td>
                            <td><?php if ($invest->resign == 1)  echo 'Donativo' ?></td>
                            <td><?php echo $invest->admin ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>

                </table>
            <?php else : ?>
                <p>No hay aportes que cumplan con los filtros.</p>
            <?php endif;?>
            </div>
        </div>
<?php
    include 'view/footer.html.php';
include 'view/epilogue.html.php';