package com.mishazharov.swimteam;

import java.util.concurrent.ThreadLocalRandom;

public class Swimmer {
	public enum Gender{BOY, GIRL};
	private Gender gender = Gender.GIRL;
	/**
	 * True = Open, False = Not open
	 */
	private boolean open = false;
	/**
	 * Just the grade
	 */
	private int grade = 9;
	private String username = "";
	private int internalId = 0;
	public Swimmer(int id) {
		internalId = id;
	};
	public void openBoy() {
		//https://stackoverflow.com/a/363692/3566388
		grade = ThreadLocalRandom.current().nextInt(9, 14);
		gender = Gender.BOY;
		open = true;
		username = "OpenBoy."+internalId;
	}
	public void openGirl() {
		grade = ThreadLocalRandom.current().nextInt(9, 14);
		gender = Gender.GIRL;
		open = true;
		username = "OpenGirl."+internalId;
	}
	public void seniorBoy() {
		grade = ThreadLocalRandom.current().nextInt(11, 14);
		gender = Gender.BOY;
		open = false;
		username = "SeniorBoy."+internalId;
	}
	public void seniorGirl() {
		grade = ThreadLocalRandom.current().nextInt(11, 14);
		gender = Gender.GIRL;
		open = false;
		username = "SeniorGirl."+internalId;
	}
	public void juniorBoy() {
		grade = ThreadLocalRandom.current().nextInt(9, 11);
		gender = Gender.BOY;
		open = false;
		username = "JuniorBoy."+internalId;
	}
	public void juniorGirl() {
		grade = ThreadLocalRandom.current().nextInt(9, 11);
		gender = Gender.GIRL;
		open = false;
		username = "JuniorGirl."+internalId;
	}
	public Gender getGender() {
		return gender;
	}
	public boolean isOpen() {
		return open;
	}
	public int getGrade() {
		return grade;
	}
	public String getUsername() {
		return username;
	}
}
