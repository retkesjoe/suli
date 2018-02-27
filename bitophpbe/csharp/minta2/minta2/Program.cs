using System;
using System.Collections.Generic;
using System.Collections.Specialized;
using System.Linq;
using System.Net;
using System.Security.Cryptography;
using System.Text;
using System.Threading.Tasks;

namespace minta2
{
    class Program
    {
        static void Main(string[] args)
        {
            var url = "http://bitophpbe.test/user/add-new";
            var client = new WebClient();
            var method = "POST";
            var parameters = new NameValueCollection();

            // Ez akkor kell, ha itt szeretnéd hashelni a password-öt
            var bytes = UTF8Encoding.UTF8.GetBytes("bitofasz");
            var hash = new SHA512Managed();

            parameters.Add("username", "johndoe");
            parameters.Add("email", "johndoe@example.com");
            // Már itt is eltudod hashalni a password-öt
            // parameters.Add("password", Convert.ToBase64String((hash.ComputeHash(bytes))));
            // de jelen esetben én most ezt megteszem backenden
            parameters.Add("password", "valami");


            var reponseData = client.UploadValues(url, method, parameters);

            var json = new WebClient().DownloadString("http://bitophpbe.test/user/read/1");
            Console.WriteLine(json);
            Console.ReadKey();
        }
    }
}
