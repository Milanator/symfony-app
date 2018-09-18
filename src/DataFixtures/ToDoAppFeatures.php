<?php

    namespace App\DataFixtures;

    use App\Entity\TodoItem;
    use App\Entity\User;
    use Doctrine\Bundle\FixturesBundle\Fixture;
    use Doctrine\Common\Persistence\ObjectManager;

    class ToDoAppFeatures extends Fixture
    {
        public function load(ObjectManager $manager)
        {
            // TODO ITEM
            $todoItem = new TodoItem();
            $todoItem->setDescription('Buy some milk');
            $todoItem->setIsDone(true);
            $todoItem->setDatetime(new \DateTime());
            $manager->persist($todoItem);

            $todoItem = new TodoItem();
            $todoItem->setDescription('Buy some bread');
            $todoItem->setIsDone(true);
            $todoItem->setDatetime(new \DateTime());
            $manager->persist($todoItem);

            $todoItem = new TodoItem();
            $todoItem->setDescription('Buy some dog');
            $todoItem->setIsDone(false);
            $todoItem->setDatetime(new \DateTime());
            $manager->persist($todoItem);

            // USER
            $user = new User();
            $user->setEmail('navratil.milann@gmail.com');
            $user->setPassword(password_hash('root', PASSWORD_BCRYPT));
            $user->setUserName('root');
            $manager->persist($user);

            $manager->flush();
        }
    }