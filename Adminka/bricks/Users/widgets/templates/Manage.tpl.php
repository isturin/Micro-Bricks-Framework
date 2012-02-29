<table class = "main">
  <thead>
  <tr>
    <td><?=__( "Фамилия" )?></td>
    <td><?=__( "Имя" )?></td>
    <td><?=__( "Логин" )?></td>
    <td><?=__( "Email" )?></td>
    <td><?=__( "Админ" )?></td>
  </tr>
  </thead>
  <tbody>
  <?
    if( count( $list ) > 0 )
    {
      foreach( $list as $item )
      {
        ?>
      <tr>
        <td><?=$item['lastname']?></td>
        <td><?=$item['firstname']?></td>
        <td><?=$item['login']?></td>
        <td><?=$item['email']?></td>
        <td><?=$item['isAdmin'] ? __( "Да" ) : __( "Нет" )?></td>
      </tr>
        <?
      }
    }
    else
    {
      ?>
    <tr>
      <td colspan = "5"><?=__( "Пользователей нет" )?></td>
    </tr>
      <?
    }
  ?>
  </tbody>
</table>