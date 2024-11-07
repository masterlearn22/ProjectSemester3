<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RandomUsersSeeder extends Seeder
{
    public function run()
    {
        // Kode seeder sebelumnya tetap ada di sini

        $animeCharacters = [
            // One Piece (tambahan karakter)
            'Monkey D. Luffy', 'Roronoa Zoro', 'Nami', 'Usopp', 'Sanji', 'Tony Tony Chopper', 'Nico Robin', 'Franky', 'Brook', 'Jinbe',
            'Portgas D. Ace', 'Sabo', 'Trafalgar Law', 'Boa Hancock', 'Buggy', 'Shanks', 'Whitebeard', 'Kaido', 'Big Mom', 'Blackbeard',
            'Doflamingo', 'Crocodile', 'Enel', 'Kuma', 'Mihawk', 'Rayleigh', 'Garp', 'Aokiji', 'Kizaru', 'Akainu',
            'Coby', 'Smoker', 'Tashigi', 'Koby', 'Helmeppo', 'Vivi', 'Carrot', 'Yamato', 'Marco', 'Perona',
            'Bartolomeo', 'Cavendish', 'Rebecca', 'Shirahoshi', 'Koala', 'Ivankov', 'Bon Clay', 'Kaku', 'Rob Lucci', 'Spandam',
        
            // Naruto (tambahan karakter)
            'Naruto Uzumaki', 'Sasuke Uchiha', 'Sakura Haruno', 'Kakashi Hatake', 'Hinata Hyuga', 'Shikamaru Nara', 'Ino Yamanaka', 'Choji Akimichi',
            'Rock Lee', 'Neji Hyuga', 'Tenten', 'Gaara', 'Temari', 'Kankuro', 'Jiraiya', 'Tsunade', 'Orochimaru', 'Itachi Uchiha',
            'Kisame Hoshigaki', 'Deidara', 'Sasori', 'Hidan', 'Kakuzu', 'Pain', 'Konan', 'Madara Uchiha', 'Obito Uchiha', 'Kaguya Otsutsuki',
            'Boruto Uzumaki', 'Sarada Uchiha', 'Mitsuki', 'Kawaki', 'Minato Namikaze', 'Kushina Uzumaki', 'Hashirama Senju', 'Tobirama Senju',
        
            // Dragon Ball (tambahan karakter)
            'Goku', 'Vegeta', 'Gohan', 'Piccolo', 'Krillin', 'Bulma', 'Trunks', 'Goten', 'Android 18', 'Frieza',
            'Cell', 'Majin Buu', 'Beerus', 'Whis', 'Jiren', 'Hit', 'Zamasu', 'Goku Black', 'Master Roshi', 'Yamcha',
            'Tien Shinhan', 'Chiaotzu', 'Mr. Satan', 'Videl', 'Pan', 'Uub', 'Android 17', 'Android 16', 'Nappa', 'Raditz',
        
            // My Hero Academia (tambahan karakter)
            'Izuku Midoriya', 'Katsuki Bakugo', 'Ochaco Uraraka', 'Tenya Iida', 'Shoto Todoroki', 'All Might', 'Eraserhead', 'Present Mic',
            'Midnight', 'Recovery Girl', 'Endeavor', 'Hawks', 'Best Jeanist', 'Mirko', 'Mt. Lady', 'Kamui Woods', 'Gran Torino', 'Nezu',
            'Momo Yaoyorozu', 'Eijiro Kirishima', 'Tsuyu Asui', 'Minoru Mineta', 'Fumikage Tokoyami', 'Mezo Shoji', 'Mina Ashido', 'Denki Kaminari',
        
            // Fullmetal Alchemist (tambahan karakter)
            'Edward Elric', 'Alphonse Elric', 'Roy Mustang', 'Riza Hawkeye', 'Winry Rockbell', 'Scar', 'Maes Hughes', 'Alex Louis Armstrong',
            'Olivier Mira Armstrong', 'Izumi Curtis', 'Van Hohenheim', 'King Bradley', 'Lust', 'Gluttony', 'Envy', 'Greed', 'Pride', 'Sloth',
        
            // Death Note (tambahan karakter)
            'Light Yagami', 'L Lawliet', 'Misa Amane', 'Near', 'Mello', 'Ryuk', 'Rem', 'Watari', 'Soichiro Yagami', 'Teru Mikami',
        
            // Tokyo Ghoul (tambahan karakter)
            'Ken Kaneki', 'Touka Kirishima', 'Rize Kamishiro', 'Shuu Tsukiyama', 'Hinami Fueguchi', 'Juuzou Suzuya', 'Kotaro Amon', 'Akira Mado',
        
            // Sword Art Online (tambahan karakter)
            'Kirito', 'Asuna', 'Klein', 'Agil', 'Silica', 'Lisbeth', 'Sinon', 'Leafa', 'Yui', 'Alice Zuberg',
        
            // Attack on Titan (tambahan karakter)
            'Eren Yeager', 'Mikasa Ackerman', 'Armin Arlert', 'Levi Ackerman', 'Erwin Smith', 'Hange Zoe', 'Jean Kirstein', 'Sasha Blouse',
            'Connie Springer', 'Historia Reiss', 'Ymir', 'Reiner Braun', 'Bertholdt Hoover', 'Annie Leonhart', 'Zeke Yeager', 'Pieck Finger',
        
            // Demon Slayer (tambahan karakter)
            'Tanjiro Kamado', 'Nezuko Kamado', 'Zenitsu Agatsuma', 'Inosuke Hashibira', 'Giyu Tomioka', 'Shinobu Kocho', 'Kyojuro Rengoku',
            'Tengen Uzui', 'Mitsuri Kanroji', 'Muichiro Tokito', 'Gyomei Himejima', 'Sanemi Shinazugawa', 'Obanai Iguro', 'Kanao Tsuyuri',
        
            // Jujutsu Kaisen (tambahan karakter)
            'Yuji Itadori', 'Megumi Fushiguro', 'Nobara Kugisaki', 'Satoru Gojo', 'Maki Zenin', 'Toge Inumaki', 'Panda', 'Kento Nanami',
            'Aoi Todo', 'Yuta Okkotsu', 'Suguru Geto', 'Mahito', 'Jogo', 'Hanami', 'Choso', 'Uraume',
        
            // Hunter x Hunter (tambahan karakter)
            'Gon Fre ecss', 'Killua Zoldyck', 'Kurapika', 'Leorio Paradinight', 'Hisoka Morow', 'Chrollo Lucilfer', 'Meruem', 'Netero',
            'Alluka Zoldyck', 'Shizuku', 'Biscuit Krueger', 'Kite', 'Feitan', 'Kuroro Lucilfer', 'Phantom Troupe', 'Knuckle Bine',
            'Shoot McMahon', 'Palm Siberia', 'Genthru', 'Mach', 'Franklin Bordeau', 'Zeno Zoldyck', 'Silva Zoldyck', 'Kalluto Zoldyck',
        ];


        
// Ulangi karakter hingga mencapai 500
        while (count($animeCharacters) < 500) {
            $animeCharacters = array_merge($animeCharacters, $animeCharacters);
        }

// Hasilkan daftar karakter anime yang cukup untuk 500 pengguna
        print_r($animeCharacters);
        
        foreach ($animeCharacters as $character) {
            $username = Str::slug($character, '');
            User::create([
                'name' => $character,
                'username' => $username,
                'email' => $username . '@gmail.com',
                'password' => Hash::make('1234567890'),
                'no_hp' => '08' . rand(1000000000, 9999999999),
                'wa' => '08' . rand(1000000000, 9999999999),
                'pin' => str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT),
                'ID_JENIS_USER' => rand(1, 4),
                'STATUS_USER' => '1',
            ]);
        }
    }
}