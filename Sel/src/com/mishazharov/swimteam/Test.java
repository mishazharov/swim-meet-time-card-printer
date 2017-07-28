package com.mishazharov.swimteam;
import java.util.ArrayList;

import org.openqa.selenium.*;
import org.openqa.selenium.chrome.ChromeDriver;
import org.openqa.selenium.chrome.ChromeOptions;
import org.openqa.selenium.support.ui.Select;

import com.mishazharov.swimteam.Swimmer.Gender;
public class Test {
	static ArrayList<Swimmer> juniorBoys = new ArrayList<Swimmer>();
	static ArrayList<Swimmer> seniorBoys = new ArrayList<Swimmer>();
	static ArrayList<Swimmer> juniorGirls = new ArrayList<Swimmer>();
	static ArrayList<Swimmer> seniorGirls = new ArrayList<Swimmer>();
	static ArrayList<Swimmer> openBoys = new ArrayList<Swimmer>();
	static ArrayList<Swimmer> openGirls = new ArrayList<Swimmer>();
	static ArrayList<Swimmer> all = new ArrayList<Swimmer>();
	public static void generateSwimmers(int users) {
		juniorBoys.clear();
		seniorBoys.clear();
		juniorGirls.clear();
		seniorGirls.clear();
		openBoys.clear();
		openGirls.clear();
		all.clear();
		for(int i = 0; i < users; i++) {
			Swimmer s = new Swimmer(i);
			s.juniorBoy();
			juniorBoys.add(s);
		}
		for(int i = 0; i < users; i++) {
			Swimmer s = new Swimmer(i);
			s.seniorBoy();
			seniorBoys.add(s);
		}
		for(int i = 0; i < users; i++) {
			Swimmer s = new Swimmer(i);
			s.juniorGirl();
			juniorGirls.add(s);
		}
		for(int i = 0; i < users; i++) {
			Swimmer s = new Swimmer(i);
			s.seniorGirl();
			seniorGirls.add(s);
		}
		for(int i = 0; i < users; i++) {
			Swimmer s = new Swimmer(i);
			s.openBoy();
			openBoys.add(s);
		}
		for(int i = 0; i < users; i++) {
			Swimmer s = new Swimmer(i);
			s.openGirl();
			openGirls.add(s);
		}
		all.addAll(juniorBoys);
		all.addAll(juniorGirls);
		all.addAll(seniorBoys);
		all.addAll(seniorGirls);
		all.addAll(openBoys);
		all.addAll(openGirls);
	}
	public static String getUserStrings() {
		String result = "";
		for(Swimmer s : juniorBoys) {
			result += s.getUsername()+",";
		}
		for(Swimmer s : juniorGirls) {
			result += s.getUsername()+",";
		}
		for(Swimmer s : seniorBoys) {
			result += s.getUsername()+",";
		}
		for(Swimmer s : seniorGirls) {
			result += s.getUsername()+",";
		}
		for(Swimmer s : openBoys) {
			result += s.getUsername()+",";
		}
		for(Swimmer s : openGirls) {
			result += s.getUsername()+",";
		}
		return result;
	}
	static String adminUsername = "mishazharov1@gmail.com";
	static String password = "test";
	static String baseUrl = "https://swimteam.mishazharov.com";
	public static boolean makeUsers = false;
	public static void sleep(int time) {
		try {
			Thread.sleep(time);
		} catch (InterruptedException e) {
			e.printStackTrace();
		}
	}
	public static void main(String[] args) {
		System.setProperty("webdriver.chrome.driver", "C:\\Users\\Misha\\Desktop\\Git\\swimteam.mishazharov.com\\Sel\\chromedriver.exe");
		
		//https://stackoverflow.com/a/38378221/3566388
		ChromeOptions chromeOptions = new ChromeOptions();
		chromeOptions.addArguments("--start-maximized");
		ChromeDriver d = new ChromeDriver(chromeOptions);
		try {
			if(makeUsers) {
				createTestUsers(d);
				logout(d);
				sleep(500);
				for(Swimmer s : all) {
					initializeUser(d, s);
				}
			}
		}catch(Exception e) {
			e.printStackTrace();
		}
		d.close();
	}
	
	public static void createTestUsers(WebDriver d) {
		d.get(baseUrl);
		sleep(300);
		d.findElement(By.cssSelector("#username")).sendKeys(adminUsername);
		d.findElement(By.cssSelector("#password")).sendKeys(password);
		sleep(1000);
		d.findElement(By.cssSelector("button.btn-default")).click();
		sleep(300);
		assert(d.getCurrentUrl().equals(baseUrl+"/home.php"));
		sleep(1000);
		d.get(baseUrl+"/users.php");
		sleep(300);
		generateSwimmers(10);
		d.findElement(By.cssSelector("#add_widget_name")).sendKeys(getUserStrings());
		
		sleep(300);
		d.findElement(By.cssSelector("#add_widget div:nth-child(10) div button")).click();
		sleep(10000);
	}
	/**
	 * Initializes a user
	 * @param d Webdriver
	 * @param username Username
	 * @param grade Grade (9, 10, 11, 12, 13)
	 * @param gender True = Boy, False = Girl
	 * @param open True = Open, False = Closed
	 */
	public static void initializeUser(WebDriver d, Swimmer s) {
		d.get(baseUrl+"/registeru.php");
		sleep(300);
		d.findElement(By.cssSelector("#username")).sendKeys(s.getUsername());
		sleep(100);
		d.findElement(By.cssSelector("button.btn")).click();
		sleep(500);
		assert(d.getCurrentUrl().equals(baseUrl+"/settings.php"));
		String gradeText = "";
		switch(s.getGrade()) {
		case 9:
			gradeText = "Gr.9";
			break;
		case 10:
			gradeText = "Gr.10";
			break;
		case 11:
			gradeText = "Gr.11";
			break;
		case 12:
			gradeText = "Gr.12";
			break;
		case 13:
			gradeText = "Victory Lap";
			break;
		}
		sleep(2000);
		//https://stackoverflow.com/a/12948221/3566388
		new Select(d.findElement(By.cssSelector("#settings_confirmation_year"))).selectByVisibleText(gradeText);
		sleep(100);
		if(s.getGender() == Gender.BOY) {
			new Select(d.findElement(By.cssSelector("#settings_confirmation_year_competes_with"))).selectByVisibleText("Boys");
		}else {
			new Select(d.findElement(By.cssSelector("#settings_confirmation_year_competes_with"))).selectByVisibleText("Girls");
		}
		sleep(100);
		if(s.isOpen()) {
			d.findElement(By.cssSelector("input[type=\"checkbox\"]")).click();
		}
		sleep(200);
		d.findElement(By.cssSelector("#new_pass")).sendKeys(password);
		sleep(100);
		d.findElement(By.cssSelector("#confirm_pass")).sendKeys(password);
		sleep(100);
		d.findElement(By.cssSelector("#change_pass_widget div:nth-child(6) div button")).click();
		sleep(200);
		d.findElement(By.cssSelector("#new_email")).sendKeys(s.getUsername()+"@example.com");
		sleep(1000);
		d.findElement(By.cssSelector("#add_email_widget div:nth-child(4) div form div:nth-child(2) div button")).click();
		sleep(2000);
		assert(d.getCurrentUrl().equals(baseUrl+"/home.php"));
		sleep(1000);
		logout(d);
		sleep(1000);
	}

	public static void logout(WebDriver d) {
		d.get(baseUrl + "/logout.php");
	}
}
