<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <title>
    Olá <?= $this->e($name) ?>
  </title>
</head>

<body>

  <div class="w-screen h-screen flex justify-center items-center">
    <div class="overflow-x-auto relative w-[800px]">
      <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
          <tr>
            <th scope="col" class="py-3 px-6">
              Nome
            </th>
            <th scope="col" class="py-3 px-6">
              Email
            </th>
            <th scope="col" class="py-3 px-6">
              Telefone
            </th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($users as $user): ?>
          <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
            <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
              <?= $this->e($user->username) ?>
            </th>
            <td class="py-4 px-6">
              <?= $this->e($user->email) ?>
            </td>
            <td class="py-4 px-6">
              <?= $this->e($user->phone) ?>
            </td>
          </tr>
          <?php endforeach ?>
        </tbody>
      </table>
    </div>
  </div>


</body>

</html>